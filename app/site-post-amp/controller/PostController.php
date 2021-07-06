<?php
/**
 * PostController
 * @package site-post-amp
 * @version 0.0.1
 */

namespace SitePostAmp\Controller;

use SitePost\Library\Meta;
use Post\Model\Post;
use LibFormatter\Library\Formatter;
use magyarandras\AMPConverter\Converter;

class PostController extends \Site\Controller
{
    public function singleAction() {
        $slug = $this->req->param->slug;

        $post = Post::getOne(['slug'=>$slug, 'status'=>3]);
        if(!$post)
            return $this->show404();

        $post = Formatter::format('post', $post, ['user', 'content']);

        $converter = new Converter();
        $converter->loadDefaultConverters();
        $post->content->amp = $converter->convert($post->content->value);

        $params = [
            'post' => $post,
            'scripts' => $converter->getScripts(),
            'meta' => Meta::single($post)
        ];

        $this->res->render('post/amp/single', $params);
        $this->res->setCache(86400);
        $this->res->send();
    }
}
