<?define ("PAGE", "docs");?>
<?include($_SERVER["DOCUMENT_ROOT"]."/assets/inc/header.php");?>

		<?
			left_side_menu("docs");
		?>

	<div class="col-12 col-md-9 markdown-body">
		<?
		echo $Parsedown->text(prepare_md(file_get_contents($GLOBALS["MENU"]["LINKS"][PAGE][$_GET['page']])));	
		?>
	</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/assets/inc/footer.php");?>