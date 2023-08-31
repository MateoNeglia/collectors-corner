<?php

namespace Collector\Models;


class Tag extends Model {
    protected int $tag_id;
    protected string $tag_name;

    protected string $table = "tags";
    protected string $primaryKey = "tag_id";
    protected array $properties = ["tag_id", "tag_name"];

    /**
     * @return int
     */
    public function getTagId(): int
    {
        return $this->tag_id;
    }

    /**
     * @param int $tag_id
     */
    public function setTagId(int $tag_id): void
    {
        $this->tag_id = $tag_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->tag_name;
    }

    /**
     * @param string $tag_name
     */
    public function setName(string $tag_name): void
    {
        $this->tag_name = $tag_name;
    }
}
