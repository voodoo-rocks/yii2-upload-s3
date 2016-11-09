<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 09/11/2016
 * Time: 17:27
 */

namespace vr\upload;

/**
 * Class S3Writer
 * @package vr\upload
 */
class S3Writer extends Writer
{
    /**
     * @var
     */
    public $accessKeyId;

    /**
     * @var
     */
    public $secretAccessKey;

    /**
     * @param $content
     *
     * @return mixed
     */
    public function save($content)
    {
        return true;
    }
}