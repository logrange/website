<?define ("PAGE", "docs-page");?>
<?include($_SERVER["DOCUMENT_ROOT"]."/header.php");?>

		<?
			left_side_menu("docs");
		?>

	<div class="col-12 col-md-9 markdown-body">
		<?
		echo $Parsedown->text(prepare_md(file_get_contents($GLOBALS["MENU"]["LINKS"]["docs"][$_GET['page']])));	
		?>
	</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>