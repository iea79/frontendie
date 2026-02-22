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
					<a href="mailto: busforward@yandex.ru" class="contacts__link">busforward@yandex.ru</a>
					<a href="https://github.com/iea79" target="_blank" class="contacts__link">GitHub</a>
					<div class="contacts__line"></div>
				</div>
				<div class="contacts__content">
					<div class="contacts__soc">
						<a href="https://t.me/busforward" target="_blank" class="contacts__link">Telegram</a>
						<a href="https://vk.com/busforward" target="_blank" class="contacts__link">Vkontakte</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contacts -->
	<footer id="colophon" class="footer">
		<div class="footer__content">
			<div class="footer__copy">© <?php echo date('Y') ?> Evgeniy Ivanov</div>
			<div>Хостинг со скидкой по промокоду <b>262A-18C5-4888-AC99</b> от <a href="https://www.reg.ru/hosting/?rlink=reflink-5956933" style="color: #fff">reg.ru</a></div>
			<div class="footer__terms">
				<span>ИНН: 590415030652</span>
				<!-- <a href="#">Пользовательское соглашение</a> -->
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div>
<!-- </div> -->
<!-- .viewport -->
<?php wp_footer(); ?>
<div class="cursor">
	<div class="icon_link"></div>
</div>
<!-- <div class="cursor__overlay"></div> -->
<!-- </div> -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
	var fired = false;
	document.addEventListener('mousemove', ymInit);
	document.addEventListener('ontouchstart', ymInit);
	document.addEventListener('DOMContentLoaded', function(e) {
		const scroll_content = document.querySelector('.scroll-content');
		window.addEventListener('scroll', ymInit);
		scroll_content.addEventListener('scroll', ymInit);
	});

	function ymInit() {
		//  setTimeout(() => {
		// 	 // Сюда вставляете метрики без тегов <script>           
		//  }, 1000)
		if (fired === false) {
			// console.log('ymInit');
			fired = true;
			(function(m, e, t, r, i, k, a) {
				m[i] = m[i] || function() {
					(m[i].a = m[i].a || []).push(arguments)
				};
				m[i].l = 1 * new Date();
				for (var j = 0; j < document.scripts.length; j++) {
					if (document.scripts[j].src === r) {
						return;
					}
				}
				k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
			})(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=105795429', 'ym');

			ym(105795429, 'init', {
				ssr: true,
				webvisor: true,
				clickmap: true,
				ecommerce: "dataLayer",
				accurateTrackBounce: true,
				trackLinks: true
			});
		}
	}
</script>
<noscript>
	<div><img src="https://mc.yandex.ru/watch/105795429" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->
</body>

</html>