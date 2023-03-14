<?php

declare(strict_types=1);

namespace infrastructure\repository\book;

use infrastructure\entity\activeRecord\Book as BookActiveRecord;
use infrastructure\entity\activeRecord\Genre;
use domain\scenario\book\read\listView\Filters;
use domain\scenario\book\read\listView\Pager;
use domain\scenario\book\create\Dto;
use domain\entity\Book as BookEntity;
use domain\repository\BookInterface;
use yii\db\ActiveQuery;
use Throwable;
use Yii;

class Book implements BookInterface
{
    private EntityConverter $entityConverter;

    private const PUBLISHED_DATE_FORMAT = 'Y-m-d';

    public function __construct(EntityConverter $entityConverter)
    {
        $this->entityConverter = $entityConverter;
    }

    public function create(Dto $dto): int
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $book = new BookActiveRecord();

            $book->title = $dto->title;
            $book->author_id = $dto->authorId;
            $book->publication_date = $dto->publishedDate;

            $book->save();

            foreach ($dto->genresId as $genreId) {
                $genre = Genre::findOne($genreId);
                $book->link('genres', $genre);
            }

            $transaction->commit();

            return $book->id;
        } catch (Throwable $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }

    public function find(int $id): ?BookEntity
    {
        $book = BookActiveRecord::findOne($id);

        return $book ? $this->entityConverter->toDomain($book) : null;
    }

    public function delete(int $id): void
    {
        BookActiveRecord::findOne($id)->delete();
    }

    public function update(BookEntity $book): void
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $bookActiveRecord = BookActiveRecord::findOne($book->getId());

            $bookActiveRecord->title = $book->getTitle();
            $bookActiveRecord->author_id = $book->getAuthor()->getId();
            $bookActiveRecord->publication_date = $book->getPublicationDate()->format(self::PUBLISHED_DATE_FORMAT);

            $bookActiveRecord->save();

            $bookActiveRecord->unlinkAll('genres', true);

            foreach ($book->getGenres() as $genre) {
                $genre = Genre::findOne($genre->getId());
                $bookActiveRecord->link('genres', $genre);
            }

            $transaction->commit();
        } catch (Throwable $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }

    public function batchGetByFilters(Filters $filters, Pager $pager): array
    {
        $query = BookActiveRecord::find()
            ->joinWith([
                'genres' => function (ActiveQuery $query) use ($filters) {
                    $query->andFilterWhere(['in', 'genres.id', $filters->genresId]);
                },
                'author' => function (ActiveQuery $query) use ($filters) {
                    $query->andFilterWhere(['authors.name' => $filters->authorName]);
                    $query->andFilterWhere(['authors.country' => $filters->authorCountry]);
                },
            ])
            ->andFilterWhere(['books.publication_date' => $filters->publicationDate])
            ->offset(($pager['page'] - 1) * $pager['limit'])
            ->limit($pager['limit']);

        return array_map(
            fn (BookActiveRecord $book) => $this->entityConverter->toDomain($book),
            $query->all()
        );
    }
}
