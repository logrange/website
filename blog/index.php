<?define ("PAGE", "blog-page");?>
<?include($_SERVER["DOCUMENT_ROOT"]."/header.php");?>

		<?
			left_side_menu("blog");
		?>
	<div class="col-12 col-md-9 markdown-body" style="display: table-cell !important">
		<?
		echo $Parsedown->text(prepare_md(file_get_contents($GLOBALS["MENU"]["LINKS"]["blog"][$_GET['page']])));	
		?>
	</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>