<?define ("PAGE", "blog-page");?>
<?include($_SERVER["DOCUMENT_ROOT"]."/header.php");?>

		<?
			left_side_menu("blog");
		?>
	<div class="markdown-body d-table-cell">
		<?
		echo $Parsedown->text(prepare_md(file_get_contents($GLOBALS["MENU"]["LINKS"]["blog"][$_GET['page']])));	
		?>
	</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>