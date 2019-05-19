<?
	if (strpos($_SERVER['PHP_SELF'], "/docs/") !== false)
	{
		$docs_class = " active";
	}
	if (strpos($_SERVER['PHP_SELF'], "/blog/") !== false)
	{
		$blog_class = " active";
	}
?>

<nav class="navbar top-navbar navbar-expand-sm navbar-light">
	<div class="container">
		<div class="position-relative w-100 text-center text-sm-left">
			<a class="navbar-brand mr-0" href="<?=SITE_PATH?>">
				<img src="<?=SITE_PATH?>images/logo.svg" class="non-mobile-only">
				<img src="<?=SITE_PATH?>images/logo-butterfly.svg" class="mobile-only">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>

			<div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
				<div class="navbar-menu">
				<ul class="navbar-nav">
					<li class="nav-item">
					<a class="nav-link<?=$docs_class?>" href="<?=SITE_PATH?>docs/">Docs</a>
					</li>
					<li class="nav-item ">
					<a class="nav-link<?=$blog_class?>" href="<?=SITE_PATH?>blog/">Blog</a>
					</li>
					<li class="nav-item ">
					<a class="nav-link<?=$download_class?>" href="<?=SITE_PATH?>download/">Download</a>
					</li>
				</ul>
				<?/*
				<form class="form-inline d-inline-block">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
				*/?>
				</div>
			</div>
		</div>
	</div>
</nav>
