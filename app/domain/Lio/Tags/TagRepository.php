<?php namespace Lio\Tags;

use Lio\Core\EloquentBaseRepository;

class TagRepository extends EloquentBaseRepository
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getAllTagsBySlug($slugString)
    {
        if (is_null($slugString)) {
            return null;
        }

        if (stristr($slugString, ',')) {
            $slugSlugs = explode(',', $slugString);
        } else {
            $slugSlugs = (array) $slugString;
        }

        return $this->model->whereIn('slug', (array) $slugSlugs)->get();
    }

    public function getTagIdList()
    {
        return $this->model->lists('id');
    }
}
