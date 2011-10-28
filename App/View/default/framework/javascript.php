<?php
$coreJSFiles = array('jquery1.4.2.min', 'generic');
$javascriptFiles = array_unique(array_merge($coreJSFiles, $core['files']['js']));
?>
<script type="text/javascript" src="<?php echo $baseUrl; ?>scripts/js.php?mod=<?php echo implode(',', $javascriptFiles); ?>"></script>