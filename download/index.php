<?define ("PAGE", "download-page");?>
<?include($_SERVER["DOCUMENT_ROOT"]."/header.php");?>

		<?
			left_side_menu("download");
		?>

	<div class="col-12 col-md-9 markdown-body">
		<?
		echo $Parsedown->text(prepare_md(file_get_contents($GLOBALS["MENU"]["LINKS"]["download"][$_GET['page']])));	
		?>
	</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>