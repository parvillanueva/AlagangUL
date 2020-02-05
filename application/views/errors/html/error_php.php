<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if(trim($message) =='Undefined property: Welcome::$db'){
	redirect("content_management/install");
}
if(trim($message) =='Undefined property: Login::$db'){
	redirect("content_management/install");
}

?>

<style type="text/css">
    html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            width: 100%;
        }

</style>
<div style="border:1px solid #dd4814;padding-left:20px;margin:10px 0;">

	<h4>A PHP Error was encountered</h4>

	<p>Severity: <?php echo $severity; ?></p>
	<p>Message:  <?php echo $message; ?></p>
	<p>Filename: <?php echo $filepath; ?></p>
	<p>Line Number: <?php echo $line; ?></p>
    <p>How to Fix : <a href="https://stackoverflow.com/search?q=codeigniter <?php echo $message; ?>" target="_blank">STOCKOVERFLOW</a> | <a href="https://www.google.com.ph/search?q=codeigniter <?php echo $message; ?>" target="_blank">GOOGLE</a></p>

	<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

		<p>Backtrace:</p>
		<?php foreach (debug_backtrace() as $error): ?>

			<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

				<p style="margin-left:10px">
				File: <?php echo $error['file'] ?><br />
				Line: <?php echo $error['line'] ?><br />
				Function: <?php echo $error['function'] ?>
				</p>

			<?php endif ?>

		<?php endforeach ?>

	<?php endif ?>

</div>
