<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 09/11/2016
 * Time: 17:27
 */

namespace vr\upload;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;

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
    public $secretKey;

    /**
     * @var
     */
    public $bucket;

    /**
     * @var string
     */
    public $root = 'uploads';

    /**
     * @var string
     */
    public $region = 'eu-west-1';

    /**
     * @param $content
     *
     * @return mixed
     */
    public function save($content)
    {
        $client = new S3Client([
            'credentials' => new Credentials($this->accessKeyId, $this->secretKey),
            'region'      => $this->region,
            'version'     => 'latest'
        ]);

        if ($this->root) {
            $this->filename = $this->root . '/' . $this->filename;
        }

        $this->filename .= '.' . $this->determineExtension($content);

        if (!$client->doesBucketExist($this->bucket)) {
            $client->createBucket([
                'Bucket' => $this->bucket
            ]);
        }

        // toDO: remove environment! It is a total crap but I had to do it (
        $client->upload($this->bucket, \Yii::$app->get('environment')->activeFlavor . '/' . $this->filename, $content, 'public-read');

        return $this->filename;
    }
}