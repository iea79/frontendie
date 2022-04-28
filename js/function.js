/*!
*
* Evgeniy Ivanov - 2022
* busforward@gmail.com
* Skype: ivanov_ea
*
*/

var app = {
    pageScroll: '',
    lgWidth: 1200,
    mdWidth: 992,
    smWidth: 768,
    resized: false,
    iOS: function() { return navigator.userAgent.match(/iPhone|iPad|iPod/i); },
    touchDevice: function() { return navigator.userAgent.match(/iPhone|iPad|iPod|Android|BlackBerry|Opera Mini|IEMobile/i); }
};

function isLgWidth() { return window.screen.width >= app.lgWidth; } // >= 1200
function isMdWidth() { return window.screen.width >= app.mdWidth && window.screen.width < app.lgWidth; } //  >= 992 && < 1200
function isSmWidth() { return window.screen.width >= app.smWidth && window.screen.width < app.mdWidth; } // >= 768 && < 992
function isXsWidth() { return window.screen.width < app.smWidth; } // < 768
function isIOS() { return app.iOS(); } // for iPhone iPad iPod
function isTouch() { return app.touchDevice(); } // for touch device


gsap.registerPlugin(ScrollTrigger);
let bodyScrollBar;

if (!isTouch()) {

    bodyScrollBar = Scrollbar.init(document.body, { damping: 0.1, delegateTo: document });
    bodyScrollBar.track.xAxis.element.remove();

    ScrollTrigger.scrollerProxy(document.body, {
        scrollTop(value) {
            if (arguments.length) {
                bodyScrollBar.scrollTop = value;
            }
            return bodyScrollBar.scrollTop;
        }
    });

}

window.onload = () => {
    document.querySelectorAll('[href="#"]').forEach((item, i) => {
        item.addEventListener('click', e => {
            e.preventDefault();
        });
    });

    checkOnResize();
};

window.addEventListener('resize', () => {
    // Запрещаем выполнение скриптов при смене только высоты вьюпорта (фикс для скролла в IOS и Android >=v.5)
    if (app.resized == screen.width) { return; }
    app.resized = screen.width;

    console.log('resize');

    checkOnResize();
});

function updateScroll() {
    if (!isTouch()) {
        bodyScrollBar.addListener(ScrollTrigger.update);
    }
}


function checkOnResize() {
    moveCursor();
    updateScroll();
}


function moveCursor() {
    if (isTouch()) return false;

    const cursor = document.querySelector('.cursor');
    const content = document.body;
    const hoveredEl = document.querySelectorAll('.cursor_showed');
    const links = document.querySelectorAll('a:not([class])');
    gsap.set(cursor, {xPercent: -50, yPercent: -50});
    // console.dir(cursor);
    const opacited = (opacity) => {
        hoveredEl.forEach(item => {
            if (opacity) {
                item.classList.add('opacited');
            } else {
                item.classList.remove('opacited');
            }
        });
    };

    content.addEventListener('mousemove', e => {
        TweenLite.to(cursor, 0.5, {
            css: {
                x: e.clientX,
                y: e.clientY
            }
        });
    });

    hoveredEl.forEach(item => {
        item.addEventListener('mouseenter', () => {
            cursor.classList.add('show');
            opacited(true);
            item.classList.remove('opacited');
        });
        item.addEventListener('mouseleave', () => {
            cursor.classList.remove('show');
            opacited(false);
        });
    });

    links.forEach(item => {
        item.addEventListener('mouseenter', () => {
            cursor.classList.add('cursor_links');
        });
        item.addEventListener('mouseleave', () => {
            cursor.classList.remove('cursor_links');
        });
    });
}

function openMobileNav() {
    if (isTouch()) {
        document.querySelector('.menu__toggle').addEventListener('click', ev => {
            document.querySelector('.nav').classList.toggle('open');
            document.body.classList.toggle('navbar__open');
            ev.target.classList.toggle('active');
        });
    }
}
openMobileNav();

// Scroll to ID // Плавный скролл к элементу при нажатии на ссылку. В ссылке указываем ID элемента
function srollToId() {
    const el = document.querySelectorAll('[href*="#"]');
    el.forEach(item => {
        item.addEventListener('click', e => {
            // console.log(e.target.href);
            const domen = location.origin;
            const hash = e.target.href.replace(location.origin + location.pathname, '');
            console.log(hash);

            document.body.classList.remove('navbar__open');
            document.querySelector('.nav').classList.remove('open');
            document.querySelector('.menu__toggle').classList.remove('active');

            if (hash === "#contacts") {
                scrollToHash('#contacts');
                return false;
            }

            if (location.pathname !== '/') {
                document.location.href = location.origin + hash;
            } else {
                scrollToHash(hash);
                return false;
            }
        });
    });

    if (location.hash) {
        scrollToHash(location.hash);
    }
}
srollToId();

function scrollToHash(hash) {
    const anchor = document.querySelector(hash);
    if (!anchor) return false;
    if (!isTouch()) {
        bodyScrollBar.scrollTo(0, anchor.offsetTop + 10, 1000);
    }
}

function stickedHeader() {
    const header = document.querySelector('.header');

    gsap.to(header, {
        scrollTrigger: {
            start: 'top top',
            trigger: '.main',
            onUpdate: ({ progress, end }) => {
                const top = document.querySelector('.homeScreen');
                let topOffset = end*progress;

                if (topOffset > top.offsetHeight) {
                    if (isTouch()) {
                        topOffset = 0;
                        header.style.position = 'fixed';
                        header.style.top = 0;
                        header.style.left = 0;
                    }
                    header.style.transform = 'translate3d(0, '+topOffset+'px, 0)'
                    header.classList.add('stiky');
                } else {
                    if (isTouch()) {
                        header.style.position = '';
                        header.style.top = '';
                        header.style.left = '';
                    }
                    header.style.transform = ''
                    header.classList.remove('stiky');
                }
            }
        }
    });

    ScrollTrigger.create({
        start: 'top top',
        trigger: '.section_dark',
        onUpdate: ({ progress }) => {
            if (progress > 0 && progress < 1) {
                header.classList.add('stiky_dark');
            } else {
                header.classList.remove('stiky_dark');
            }
        }
    });

}
stickedHeader();

function animateHomeScreen() {
    if (isTouch()) return false;
    const fScreen = document.querySelector('.homeScreen');
    const fScreenText = document.querySelector('.homeScreen__content');
    const fScreenBg = document.querySelector('.homeScreen__bg');

    gsap.timeline()
        .from('.header', {
            y: '-100%',
            opacity: 0,
            duration: 0.8
        })
        .from('.homeScreen__title h1', {
            y: '100%',
            // opacity: 0,
            duration: 0.8
        })
        .from('.homeScreen__name span', {
            y: '100%',
            // opacity: 0
        })
        .from('.homeScreen__sub p', {
            y: '100%',
            stagger: 0.2,
            opacity: 0
        });

    gsap.to(fScreenText, {
        scrollTrigger: {
            // markers: true,
            trigger: fScreen,
            start: "top top",
            end: "bottom 0",
            scrub: 1,
            onUpdate: ({progress}) => {
                fScreenText.style.transform = 'translate3d(0, '+progress*170+'%, 0)';
                // updateScroll();
            }
        }
    });

    gsap.to(fScreenBg, {
        opacity: 0.2,
        scrollTrigger: {
            // markers: true,
            trigger: fScreen,
            start: "top top",
            end: "bottom 0",
            scrub: 1,
            onUpdate: ({progress}) => {
                fScreenBg.style.transform = 'translate3d(0, '+progress*60+'%, 0) scale('+(1+(progress/9))+')';
                // updateScroll();
            }
        }
    });
}
animateHomeScreen();

function animateWorksSection() {
    const worksSection = document.querySelector('.works');

    gsap.from('.works__nav li', {
        opacity: 0,
        yPercent: 100,
        stagger: 0.1,
        scrollTrigger: {
            trigger: worksSection,
            start: "top 60%",
            end: "bottom",
            toggleActions: 'play reverse play reverse',
        }
    });

    function animateWorks( el, delay = 0 ) {
        const pict = el.querySelector('.works__pict img');
        const name = el.querySelector('.works__name');
        const date = el.querySelector('.works__date');

        const opt = {
            // markers: true,
            trigger: el,
            start: "-80% bottom",
            toggleActions: 'play pause play reverse',
        };

        gsap.from(el, {
            delay: delay,
            // ease: "power3.easeOut",
            opacity: 0,
            yPercent: 80,
            duration: 1,
            scrollTrigger: opt
        });
        gsap.from(pict, {
            delay: delay,
            opacity: 0,
            scale: 1.3,
            duration: 1.3,
            scrollTrigger: opt
        });
        gsap.from(name, {
            delay: delay,
            // ease: "power3.easeOut",
            opacity: 0,
            y: 100,
            duration: 1.6,
            scrollTrigger: opt
        });
        gsap.from(date, {
            delay: delay,
            // ease: "power3.easeOut",
            opacity: 0,
            y:130,
            duration: 1.8,
            scrollTrigger: opt
        });

    }

    gsap.utils.toArray(".works__item:nth-child(odd)").forEach(item => {
        animateWorks( item, delay = 0 );
    });

    gsap.utils.toArray(".works__item:nth-child(even)").forEach(item => {
        animateWorks( item, delay = 0.5 )
    });
}
animateWorksSection();

// class WorksServise {
//     // _url = '/wp-json/wp/v2/projects?per_page=100';
//
//     async getWorks(sort = '') {
//         const resp = await fetch(`/wp-json/wp/v2/projects?per_page=100${sort}`);
//         console.log(resp);
//         if (!resp.ok) {
//             return new Error();
//         }
//         return await resp.json();
//     }
// }
//
// function sortingWorks() {
//     if (!document.body.classList.contains('archive')) return false;
//     const works = new WorksServise();
//
//     const wrappers = document.querySelector('.works__list');
//     const template = (data) => {
//         const date = new Date(data.date);
//         const dateOptions = {
//             era: 'long',
//             year: 'numeric',
//             month: 'long',
//             day: 'numeric',
//             weekday: 'long',
//             timezone: 'UTC',
//             hour: 'numeric',
//             minute: 'numeric',
//             second: 'numeric'
//         };
//         return `<a href="${data.props.link}" class="works__item cursor_showed" target="_blank">
//             <span class="works__pict">
//                 ${data.props.image}
//             </span>
//             <span class="works__date">${date.getFullYear()} ${date.getMonth()}</span>
//             <span class="works__name">${data.title.rendered}</span>
//         </a>`
//     };
//
//     works.getWorks().then(json => {
//         console.log(json);
//         json.forEach((item, i) => {
//             console.log(template(item));
//         });
//     });
//
// }
// sortingWorks();
