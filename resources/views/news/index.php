<h1>List news</h1>
<br>
<?php foreach($news as $n): ?>
   <div>
       <strong><a href="<?=route('news.show', [
               'id' => $n['id']
           ])?>"><?=$n['title']?></a></strong>
       <p><?=$n['description']?></p>
   </div>
<?php endforeach; ?>
