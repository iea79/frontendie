<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package frondendie
 */

?>
			<div class="footer__wrap">
				<!-- begin contacts -->
				<div id="contacts" class="contacts section section_dark">
					<div class="contacts__wrap">
						<div class="container_center">
							<div class="contacts__top">
								<a href="mailto: busforward@gmail.com" class="contacts__link">busforward@gmail.com</a>
								<a href="https://github.com/iea79" target="_blank" class="contacts__link">GitHub</a>
								<div class="contacts__line"></div>
							</div>
							<div class="contacts__content">
								<div class="contacts__soc">
									<a href="https://t.me/busforward" target="_blank" class="contacts__link">Telegram</a>
									<a href="https://vk.com/busforward" target="_blank" class="contacts__link">Vkontakte</a>
									<a href="skype:ivanov_ea?chat" target="_blank" class="contacts__link">Skype</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end contacts -->
				<footer id="colophon" class="footer">
					<div class="footer__content">
						<div class="footer__copy">©<?php echo date('Y') ?> Evgeniy Ivanov</div>
						<div class="footer__terms">
							<span>ИНН: 590415030652</span>
							<a href="#">Пользовательское соглашение</a>
						</div>
					</div><!-- .site-info -->
				</footer><!-- #colophon -->
			</div>
		<!-- </div> -->
		<!-- .viewport -->
		<?php wp_footer(); ?>
		<div class="cursor"><div class="icon_link"></div></div>
		<!-- <div class="cursor__overlay"></div> -->
		<!-- </div> -->
	</body>
</html>
