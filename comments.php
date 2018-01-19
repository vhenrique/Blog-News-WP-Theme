<?php

// Do not delete these lines
	if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die('Please do not load this page directly. Thanks!');

	if(post_password_required()){ ?>
		<p class="nocomments">Este post é protegido com senha. Entre com a sua senha para ver os comentários.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if(have_comments()): ?>
	<h3 id="comments"><?php comments_number('Sem comentários', '1 comentário', '% comentários');?></h3>
	<ul class="commentlist">
		<?php wp_list_comments(); ?>
	</ul>
	<div class="navigation">
		<div class="next-comments"><?php previous_comments_link() ?></div>
		<div class="prev-comments"><?php next_comments_link() ?></div>
	</div>
<?php else : // this is displayed if there are no comments so far ?>
	<?php if(comments_open()): ?>
	<?php else : // comments are closed ?>
		<p class="nocomments">Este post está fechado para comentários.</p>
	<?php endif; ?>
<?php endif; ?>

<?php if(comments_open()): ?>
	<div id="respond">
		<h3>Deixe seu comentário</h3>
		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>
		<?php if(get_option('comment_registration') && !is_user_logged_in()): ?>
			<p>Você deve estar <a href="<?php echo wp_login_url(get_permalink()); ?>" title="Fazer login">logado</a> para postar um comentário.</p>
		<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if(is_user_logged_in()): ?>
					<p>Logado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Fazer logout">Logout &raquo;</a></p>
				<?php else : ?>
					<p><label for="author">Nome</label>
					<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></p>
					<p><label for="email">Email <small>(Não será publicado)</small></label>
					<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></p>
					<p><label for="url">Site</label>
					<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" /></p>
				<?php endif; ?>
				<p><label for="comment">Comentário</label>
				<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
				<p><input name="submit" type="submit" id="submit" tabindex="5" value="Enviar comentário" /><?php comment_id_fields(); ?></p>
				<?php do_action('comment_form', $post->ID); ?>
			</form>
		<?php endif; ?>
	</div>
<?php endif; ?>