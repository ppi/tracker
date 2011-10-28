<article class="content-box home">
    <?php if($isLoggedIn): ?>
    <?php endif; ?>
    <p class="title">Select a project</p>
    <ul>
    <?php
        if(count($repos) > 0) {
            foreach($repos as $repo) {
                echo "<li><a href='".$baseUrl."ticket/index/filter/cat/". str_replace(' ', '-', $repo["repoName"])."'>".$repo["repoName"]."</a></li>";
            }
        } else {
            echo 'No Categories present.';
        }
    ?>
    </ul>
</article>