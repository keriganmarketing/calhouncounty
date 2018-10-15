<article>
    <header>
        <h2>{{ $post->post_title }}</h2>
    </header>
    <p>{{ wp_trim_words($post->post_content, 20, '...') }}</p>
    <p><a href="{{ get_permalink($post) }}" >Read more</a></p>
    <hr>
</article>