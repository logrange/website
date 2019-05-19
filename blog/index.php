<?define ("PAGE", "blog-page");?>
<?include($_SERVER["DOCUMENT_ROOT"]."/header.php");?>
<?require_once ($_SERVER["DOCUMENT_ROOT"]."/Parsedown.php")?>

	<div class="col-md-3 d-none d-md-flex left-side-menu">
		<div class="dropdown-menu show">
		<?
			left_side_menu("blog");
		?>
		</div>
	</div>
	<div class="col-12 col-md-9 markdown-body">
		<?
		$Parsedown = new Parsedown();
		echo $Parsedown->text(prepare_md(file_get_contents($GLOBALS["MENU"]["LINKS"]["blog"][$_GET['page']])));	
		?>
	</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>