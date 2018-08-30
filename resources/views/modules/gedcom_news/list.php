<?php use Fisharebest\Webtrees\Auth; ?>
<?php use Fisharebest\Webtrees\Functions\FunctionsDate; ?>
<?php use Fisharebest\Webtrees\I18N; ?>

<?php if (empty($articles)): ?>
	<?= I18N::translate('No news articles have been submitted.') ?>
<?php endif ?>

<?php foreach ($articles as $n => $article): ?>
	<?php if ($n === 5 && count($articles) > 5): ?>
		<p>
			<a class="btn btn-link" data-toggle="collapse" data-target="#more-news-<?= e($block_id) ?>" role="button" aria-expanded="false" aria-controls="more-news-<?= e($block_id) ?>"><?= I18N::translate('More news articles') ?>
			</a>
		</p>
		<div class="collapse" id="more-news-<?= e($block_id) ?>">
	<?php endif ?>

	<div class="news_box">
		<div class="news_title"><?= e($article->subject) ?></div>
		<div class="news_date"><?= FunctionsDate::formatTimestamp($article->updated) ?></div>
		<div style="white-space: pre-wrap"><?= e($article->body) ?></div>

		<?php if (Auth::isManager($tree)): ?>
			<hr>
			<form action="<?= e(route('module', ['module' => 'gedcom_news', 'action' => 'DeleteNews', 'news_id' => $article->news_id, 'ged' => $tree->getName()])) ?>" method="post">
				<?= csrf_field() ?>
				<a class="btn btn-link" href="<?= e(route('module', ['module' => 'gedcom_news', 'action' => 'EditNews', 'news_id' => $article->news_id, 'ged' => $tree->getName()])) ?>">
					<?= I18N::translate('Edit') ?>
				</a>
				|
				<button class="btn btn-link" type="submit" data-confirm="<?= I18N::translate('Are you sure you want to delete “%s”?', e($article->subject)) ?>" onclick="return confirm(this.dataset.confirm);">
					<?= I18N::translate('Delete') ?>
				</button>
			</form>
		<?php endif ?>
	</div>
<?php endforeach ?>

<?php if (count($articles) > 5): ?>
	</div>
<?php endif ?>

<?php if (Auth::isManager($tree)): ?>
	<p>
		<a href="<?= e(route('module', ['module' => 'gedcom_news', 'action' => 'EditNews', 'ged' => $tree->getName()])) ?>">
			<?= I18N::translate('Add a news article') ?>
		</a>
	</p>
<?php endif ?>
