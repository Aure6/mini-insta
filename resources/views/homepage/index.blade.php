<h1>Liste des posts</h1>
<ul>
  @foreach($posts as $post)
  <li>{{ $post->caption }}</li>
  @endforeach
</ul>
