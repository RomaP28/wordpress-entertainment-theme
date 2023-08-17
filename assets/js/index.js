document.addEventListener('DOMContentLoaded', function (e) {
    if (window.location.href.indexOf('book-a-party=yes') !== -1) {
        document.querySelector('[data-modal="book"]').classList.remove('hidden');
    }
    console.log(localStorage.getItem('location'));
    if (localStorage.getItem('location') !== 'true') {
        document.querySelector('[data-modal="locations"]').classList.remove('hidden');
    }
    mobileMenuInit();
    paginationInit();

    var slidesVideo = document.querySelectorAll('.home .slider-360 .swiper .swiper-slide');
    var slidesVideo2 = document.querySelectorAll('.releases .ambassadors-slider .swiper .swiper-slide');
    slider360InitVideoPreview(slidesVideo);
    slider360InitVideoPreview(slidesVideo2);

    $('[data-modal="book"] [name="mobile"]').inputmask("999-999-9999");
    let inpOfAttendance = document.querySelector('[data-modal="book"] [name="estimatedAttendance"]');
    inpOfAttendance.addEventListener('keypress', function (ev) {
        if (ev.key === 'e' || ev.key === 'E') {
            ev.preventDefault();
        }
    });

    $('[data-modal="book"] [name="eventDate"]').Zebra_DatePicker();

    var searchHeaderShow = document.querySelector('.nav .top-nav .submit-search');
    var searchHeaderForm = document.querySelector('.nav .searchform');
    var searchPageForm = document.querySelector('.search-section .searchform');

    if (searchHeaderShow) {
        var searchContainer = searchHeaderShow.closest('.search');
        if (!searchContainer.classList.contains('open')) {
            searchHeaderShow.addEventListener('click', () => {
                searchContainer.classList.add('open');
                searchHeaderShow.addEventListener('click', addSubmit);
            })
        }

        function addSubmit() {
            let searchQuery = document.querySelector('.nav .search-input').value;
            if (searchQuery.trim()) {
                const queryString = `${searchHeaderForm.getAttribute("action")}/?s=${searchQuery}`
                searchHeaderForm.setAttribute("action", queryString)
                searchHeaderForm.submit();
            } else {
                searchHeaderShow.removeEventListener('click', addSubmit);
                searchContainer.classList.remove('open');

            }
        }
    }
    if (searchHeaderForm)
        searchHeaderForm.addEventListener('submit', e => {
            const searchQuery = document.querySelector('.nav .search-input').value;
            if (searchQuery.trim()) {
                const queryString = `${searchHeaderForm.getAttribute("action")}/?s=${searchQuery}`
                searchHeaderForm.setAttribute("action", queryString)
            } else {
                e.preventDefault();
            }
        });

    if (searchPageForm)
        searchPageForm.addEventListener('submit', e => {
            const searchQuery2 = document.querySelector('.search-section .search-input').value;
            if (searchQuery2.trim()) {
                const queryString2 = `${searchPageForm.getAttribute("action")}/?s=${searchQuery2}`
                searchPageForm.setAttribute("action", queryString2)
            } else {
                e.preventDefault();
            }
        });


    var locationModal = document.querySelectorAll('.modal[data-modal="locations"] input');

    if (locationModal.length > 0) {
        locationModal.forEach(function (el) {
            el.addEventListener('change', function (e) {
                // console.log(e.currentTarget)
                locationModal.forEach(function (elem) {
                    if (elem !== el) {
                        // console.log('true')
                        var container = elem.closest('label');
                        if (container.classList.contains('checked')) {
                            container.classList.remove('checked');
                        }
                    }
                })
                var label = e.currentTarget.closest('label');
                if (!label.classList.contains('checked')) {
                    label.classList.add('checked');
                }
            })
        })
    }

    var homeSwiperEvents = document.querySelector('.home-page .cards.swiper');
    if (homeSwiperEvents) {
        new Swiper('.home-page .cards.swiper', {
            slidesPerView: 'auto',
            spaceBetween: 20
        });
    }

    var homeSwiper = document.querySelector('.home-page .slider-360 .swiper');
    if (homeSwiper) {
        new Swiper('.home-page .slider-360 .swiper', {
            slidesPerView: 'auto',
            spaceBetween: 16,
            autoplay: {
                delay: 3000,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    spaceBetween: 36
                }
            }
        });
    }

    var homeReviewsSwiper = document.querySelector('.home-page .reviews .swiper');
    if (homeReviewsSwiper) {
        var startPos = 0;
        var reviewsSwiper = new Swiper('.home-page .reviews .swiper', {
            slidesPerView: 'auto',
            // loop: true,
            centeredSlides: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            spaceBetween: 82,
            on: {
                transitionEnd: function (swiper) {
                    var slides = document.querySelectorAll('.home-page .reviews .swiper .swiper-slide');
                    var prev = null;
                    var next = null;
                    var active = null;
                    slides.forEach(function (el) {
                        if (el.classList.contains('swiper-slide-prev')) {
                            prev = el;
                            el.style.transition = 'rotate 0.3s ease-in-out';
                        }
                        if (el.classList.contains('swiper-slide-next')) {
                            next = el;
                            el.style.transition = 'rotate 0.3s ease-in-out';
                        }
                        if (el.classList.contains('swiper-slide-active')) {
                            active = el;
                            el.style.transition = 'rotate 0.3s ease-in-out';
                        }
                    })
                    startPos = 0;
                    if (active) {
                        if (active.style.removeProperty) {
                            active.style.removeProperty('rotate');
                        } else {
                            active.style.removeAttribute('rotate');
                        }
                    }
                    if (prev) {
                        prev.style.rotate = `-10deg`;
                    }
                    if (next) {
                        next.style.rotate = `10deg`;
                    }
                },
                progress: function (swiper, progress) {
                    var florProgress = (progress * 10).toFixed(2);
                    var slides = document.querySelectorAll('.home-page .reviews .swiper .swiper-slide');
                    var prev = null;
                    var next = null;
                    var active = null;
                    slides.forEach(function (el) {
                        if (el.classList.contains('swiper-slide-prev')) {
                            prev = el;
                            el.style.transition = 'none';
                        }
                        if (el.classList.contains('swiper-slide-next')) {
                            next = el;
                            el.style.transition = 'none';
                        }
                        if (el.classList.contains('swiper-slide-active')) {
                            active = el;
                            el.style.transition = 'none';
                        }
                    })
                    if (startPos === 0) {
                        if (florProgress >= 0) {
                            startPos = florProgress;
                        } else {
                            startPos = 1;
                        }
                        return;
                    }
                    var buf = florProgress / 5;
                    if ((startPos > florProgress) && prev) {
                        if (1 > buf && buf > 0.01) {
                            prev.style.rotate = `-${(buf * 10)}deg`;
                            active.style.rotate = `${10 - (buf * 10)}deg`;
                        } else if (2 > buf && buf > 1) {
                            prev.style.rotate = `-${(buf * 10) - 10}deg`;
                            active.style.rotate = `${20 - (buf * 10)}deg`;
                        }
                    } else if ((startPos < florProgress) && next) {
                        if (1 > buf && buf > 0.01) {
                            next.style.rotate = `${10 - (buf * 10)}deg`;
                            active.style.rotate = `-${(buf * 10)}deg`;
                        } else if (2 > buf && buf > 1) {
                            next.style.rotate = `${20 - (buf * 10)}deg`;
                            active.style.rotate = `-${(buf * 10) - 10}deg`;
                        }
                    }
                }
            }
        });
    }

    var dataPos = document.querySelectorAll('.home-page .special-events [data-pos]');
    var dataPosContent = document.querySelectorAll('.home-page .special-events [data-pos-content]');
    var navArrows = document.querySelectorAll('.home-page .special-events [data-arrow]');
    var navArrowsMob = document.querySelectorAll('.home-page .nav-arrows.mob [data-arrow]');

    if (dataPos.length > 0) {
        if (!window.matchMedia('(max-width: 991px)').matches) {

            dataPos.forEach(function (el) {
                el.addEventListener('click', function (e) {
                    let clicked = Array.from(dataPos).indexOf(el);

                    if(el.classList.contains('active')) {
                        clicked++;
                        if (clicked === dataPos.length) {
                            clicked = 0;
                        }

                    }
                    document.querySelectorAll('.home-page .special-events [data-pos]').forEach(elem => elem.classList.remove('active'));

                    dataPos[clicked].dataset.pos = 1;
                    dataPosContent[clicked].dataset.posContent = 1;
                    dataPos[clicked].classList.add('active');

                    let action = "add";
                    let tempNum = dataPos.length - clicked;

                    for (let i = 0; i < dataPos.length; i++) {

                        if (dataPos[i].classList.contains('active')) {
                            action = "subtract";
                            tempNum = clicked;
                            continue;
                        }
                        if (action === "add") {
                            dataPos[i].dataset.pos = (i + 1) + tempNum;
                            dataPosContent[i].dataset.posContent = (i + 1) + tempNum;

                        } else if (action === "subtract") {
                            dataPos[i].dataset.pos = (i + 1) - tempNum;
                            dataPosContent[i].dataset.posContent = (i + 1) - tempNum;
                        }
                    }
                })
            })

        } else { // mobile

            var startPos = 0, degree, direction;

            dataPosContent.forEach(el => {
                el.addEventListener('touchmove', function (e) {
                    direction = e.touches[0].clientX < startPos ? "left" : "right";

                    if (direction === 'left') {

                        degree = (e.touches[0].clientX - startPos) / 26;
                        if (degree < -4) {
                            degree = -4;
                        }
                        if(degree < -2) {
                            el.style.transformOrigin = 'bottom left';
                            el.style.transform = `rotate(${degree - 5}deg)`;
                        }
                    } else {
                        degree = (e.touches[0].clientX - startPos) / 26;
                        if (degree > 4) {
                            degree = 4;
                        }
                        if (degree > 2) {
                            dataPosContent.forEach(elem => {
                                if (elem.dataset.posContent == 1 || elem.dataset.posContent == 2 || elem.dataset.posContent == 3) {
                                    elem.style.transformOrigin = 'bottom right';
                                    elem.style.transform = `rotate(${degree + 5}deg)`;
                                }
                            })
                        }

                    }

                });
                el.addEventListener('touchend', function (e) {
                    if (degree === 4 || degree === -4) {
                        startPos = 0;
                        degree = 0;
                        if (direction === 'left') {
                            dataPosContent.forEach(elem => {
                                if (elem.dataset.posContent == 1) {
                                    elem.dataset.posContent = dataPosContent.length + 1;
                                }
                                elem.dataset.posContent--;
                            });
                            el.style.transform = `rotate(0deg)`;
                        } else {
                            dataPosContent.forEach(item=>{
                                if (item.dataset.posContent == dataPosContent.length){
                                    item.dataset.posContent = 0;
                                }
                                item.dataset.posContent++;
                                item.style.transform = `rotate(0deg)`;
                            });
                            dataPosContent.forEach(card => card.style.transform = `rotate(0deg)`);
                        }
                    } else {
                        dataPosContent.forEach(card => card.style.transform = `rotate(0deg)`);
                    }
                });
                el.addEventListener('touchstart', function (e) {
                    startPos = e.touches[0].clientX;
                })

            })
        }
    }

    if (!window.matchMedia('(max-width: 991px)').matches) {
        if (navArrows.length > 0) {
            navArrows.forEach(function (el) {
                el.addEventListener('click', function (e) {
                    const active = document.querySelector('.home-page .special-events [data-pos].active');
                    if (el.dataset.arrow === 'right') {
                        active.click();
                    } else {
                        for (let i = 0; i < dataPos.length; i++) {
                            if (dataPos[i].dataset.pos == dataPos.length) {
                                dataPos[i].dataset.pos = 0
                                dataPosContent[i].dataset.posContent = 0;
                            }
                            dataPos[i].dataset.pos++;
                            dataPosContent[i].dataset.posContent++;
                        }
                    }
                });
            });
        }
    } else {  // mobile arrows

        if (navArrowsMob.length > 0) {
            navArrowsMob.forEach(function(el) {
                el.addEventListener('click', function (e) {
                    var e1 = new Event('touchstart');
                    var e2 = new Event('touchmove');

                    e1.touches = [{clientX: 0}];
                    e2.touches = el.dataset.arrow === 'right' ? [{clientX: 390}]: [{clientX: -390}];

                    document.querySelector('.home-page .special-events [data-pos-content="1"]').dispatchEvent(e1);
                    document.querySelector('.home-page .special-events [data-pos-content="1"]').dispatchEvent(e2);
                    let timerID = setTimeout(()=> {
                        var e3 = new Event('touchend');
                        document.querySelector('.home-page .special-events [data-pos-content="1"]').dispatchEvent(e3);
                        clearTimeout(timerID);
                    }, 400);

                });
            })
        }
    }

    var eatSwiper = document.querySelector('.eat-page .products-types .swiper');
    if (eatSwiper) {
        var menuSwiper = new Swiper(".eat-page .products-types .swiper", {
            slidesPerView: 3,
            spaceBetween: 0,
            loop: true,
            centeredSlides: true,
            slideToClickedSlide: true,
            on: {
                slideChangeTransitionEnd: function () {
                    var slider = this;

                    for (const sliderKey in slider.slides) {
                        if (!slider.slides.hasOwnProperty(sliderKey)) return;
                        var el = slider.slides[sliderKey];
                        if (el.classList.contains('swiper-slide-active')) {
                            var menuContainer = document.querySelectorAll('.products-section .product-types-menu [data-type-selected]');
                            menuContainer.forEach(function (elem) {
                                if (elem.dataset.typeSelected === el.dataset.type) {
                                    if (elem.classList.contains('hidden')) {
                                        elem.classList.remove('hidden');
                                    }
                                } else {
                                    if (!elem.classList.contains('hidden')) {
                                        elem.classList.add('hidden');
                                    }
                                }
                            })
                        }
                    }
                },
            },
            breakpoints: {
                1680:{
                    slidesPerView: 4,
                },
                1200: {
                    slidesPerView: 3,
                },
                320: {
                    slidesPerView: 'auto',
                }
            }
        });
    }

    var eventsSwiper = document.querySelector('.events-page .events-carousel .swiper');
    if (eventsSwiper) {
        let titles = document.querySelectorAll('.events-carousel .inner .title');
        titles = Array.from(titles).map(el => el.innerHTML);

        var eventSwiper = new Swiper(eventsSwiper, {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + titles[index] + '</span>';
                },
                dynamicBullets: true
            },
            breakpoints: {
                320: {
                    pagination: {
                        dynamicMainBullets: 1
                    }
                },
                600: {
                    pagination: {
                        dynamicMainBullets: 2
                    }
                },
                820: {
                    pagination: {
                        dynamicMainBullets: 3
                    }
                },
                992: {
                    pagination: {
                        dynamicMainBullets: 4
                    }
                }

            }
        })

    }

    var logoSwiper = document.querySelector('.cares .logo-carousel .swiper');
    if (logoSwiper) {
        new Swiper(logoSwiper, {
            loop: true,
            speed: 1000,
            breakpoints: {
                300: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                600: {
                    slidesPerView: 'auto',
                    spaceBetween: 35,
                },
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    var communitySwiper = document.querySelector('.cares .community .swiper');
    if (communitySwiper) {
        new Swiper(communitySwiper, {
            loop: true,
            speed: 1000,
            height: 150,
            breakpoints: {
                300: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                600: {
                    slidesPerView: 'auto',
                    spaceBetween: 24,
                },
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        })
    }

    var pressSwiper = document.querySelector('.releases .swiper');
    if (pressSwiper) {
        new Swiper(pressSwiper, {
            loop: true,
            speed: 1000,
            height: 150,
            slidesPerView: 3,
            spaceBetween: 32,
            breakpoints: {
                300: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                991: {
                    slidesPerView: 3,
                }
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        })
    }


    var homeDragBlockMobile = document.querySelector('.special-events .images');

    if (homeDragBlockMobile) {
        var imgItems = homeDragBlockMobile.querySelectorAll('[data-pos]');
        var lastImage = imgItems[imgItems.length - 1];
        console.log(lastImage)
        var lastImageOffset = lastImage.offsetLeft;
        lastImage.style.right = `calc(${lastImage.style.right} - ${lastImageOffset})`;
    }

    moreInfoBlockInit();

    var eventsListItems = document.querySelectorAll('.events-page .events-list .item .title a');
    var eventsItemsClose = document.querySelectorAll('.events-page .events-list .item .content .close');

    if (eventsListItems.length > 0) {
        eventsListItems.forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                el.classList.toggle('active');
                var container = el.closest('.item').querySelector('.accordion');
                container.classList.add('open');
                var innerContent = container.querySelector('.content');
                !container.style.height || container.style.height === '0px' ? container.style.height = innerContent.clientHeight + 'px' : container.style.height = '0px';
            })
        })
        eventsItemsClose.forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                var container = el.closest('.accordion');
                container.classList.remove('open');
                container.style.height = '0';
                var openLink = el.closest('.item').querySelector('.title a');
                openLink.classList.remove('active');
            })
        })
    }

    var accordionTitles = document.querySelectorAll('.kbyg .accordion .title');
    var accordionItems = document.querySelectorAll('.kbyg .accordion .item');

    if (accordionTitles.length > 0) {
        accordionTitles.forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                var item = el.closest('.item');
                var content = item.querySelector('.text');
                if (item.classList.contains('open')) {
                    item.classList.remove('open');
                    content.style.height = '0px';
                } else {
                    accordionItems.forEach(function (elem) {
                        var i = elem.closest('.item');
                        if (i.classList.contains('open')) {
                            var c = i.querySelector('.text');
                            i.classList.remove('open');
                            c.style.height = '0px';
                        }
                    })
                    item.classList.add('open');
                    content.style.height = content.querySelector('.inner-text').clientHeight + 'px';
                }
            })
        })
    }

    var tabsKBYG = document.querySelectorAll('.kbyg .faq .tabs .tab');
    var tabsContentKBYG = document.querySelectorAll('.kbyg .faq .content .info');

    if (tabsKBYG.length > 0) {
        tabsKBYG.forEach(function (el) {
            el.addEventListener('click', function (e) {
                if (!el.classList.contains('active')) {
                    tabsKBYG.forEach(function (elem) {
                        if (elem.classList.contains('active')) {
                            elem.classList.remove('active');
                        }
                    })
                    tabsContentKBYG.forEach(function (elem) {
                        if (elem.classList.contains('active')) {
                            elem.classList.remove('active');
                        }
                        if (el.dataset.faqTab === elem.dataset.faqContent) {
                            elem.classList.add('active');
                        }
                    })
                    el.classList.add('active');
                }
            })
        })
    }

    var mobileTabsKBYG = document.querySelectorAll('.kbyg .faq .mobile-tabs .tab-mobile');
    var mobileKBYGSelect = document.querySelector('.kbyg .faq .mobile-tabs');
    var mobileKBYGSelectTitle = document.querySelector('.kbyg .faq .mobile-tabs .title');
    var mobileKBYGSelectArrow = document.querySelector('.kbyg .faq .mobile-tabs .arrow');

    function openMobileContentKBYG(e) {
        e.stopPropagation();
        if (mobileKBYGSelect.classList.contains('open')) {
            mobileKBYGSelect.classList.remove('open');
            mobileKBYGSelect.style.height = '90px';
        } else {
            mobileKBYGSelect.classList.add('open');
            var items = mobileKBYGSelect.querySelectorAll('div');
            var height = 0;
            items.forEach(function (element) {
                height += element.clientHeight;
            })
            height += 44;
            mobileKBYGSelect.style.height = height + 'px';
        }
    }

    if (mobileTabsKBYG.length > 0) {
        mobileKBYGSelect.addEventListener('click', openMobileContentKBYG);
        mobileKBYGSelectTitle.addEventListener('click', openMobileContentKBYG);
        mobileKBYGSelectArrow.addEventListener('click', openMobileContentKBYG);

        mobileTabsKBYG.forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.stopPropagation();
                if (!el.classList.contains('active')) {
                    mobileTabsKBYG.forEach(function (elem) {
                        if (elem.classList.contains('active')) {
                            elem.classList.remove('active');
                        }
                    })
                    tabsContentKBYG.forEach(function (elem) {
                        if (elem.classList.contains('active')) {
                            elem.classList.remove('active');
                        }
                        if (el.dataset.faqTab === elem.dataset.faqContent) {
                            elem.classList.add('active');
                        }
                    })
                    el.classList.add('active');
                    openMobileContentKBYG(e);
                }
            })
        })
    }

    var openJobIframe = document.querySelectorAll('.career [data-job-iframe-open]');

    if (openJobIframe.length > 0) {
        openJobIframe.forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                el.closest('body').classList.add('job-opening');
            })
        })
    }

    modalLocationInit();

    var eventsList = document.querySelector('.events-page .events-list .mobile-list');

    if (eventsList) {
        touchDragInit(eventsList);
    }

    var playList = document.querySelector('.play-page .content-section.mobile-only');

    if (playList && window.matchMedia('(max-width: 600px)').matches) {
        touchDragInit(playList);
    }

    foodAndEatInit();

    openCards();

    var clearSearchPageBtn = document.querySelector('.search-section form .clear');
    if(clearSearchPageBtn) {
        var inputSearch = clearSearchPageBtn.closest('form').querySelector('input');
    }

    function inputHandler(e) {
        if (e.currentTarget.value) {
            clearSearchPageBtn.style.display = 'block';
        } else {
            clearSearchPageBtn.style.display = 'none';
        }
    }
    if (inputSearch) {
        var elem = {currentTarget: inputSearch};
        inputHandler(elem);
        inputSearch.addEventListener('input', inputHandler);
        inputSearch.addEventListener('propertychange', inputHandler); // for IE8
        // Firefox/Edge18-/IE9+ don’t fire on <select><option>
        inputSearch.addEventListener('change', inputHandler);
    }
    if (clearSearchPageBtn) {
        clearSearchPageBtn.addEventListener('click', function (e) {
            inputSearch.value = '';
            clearSearchPageBtn.style.display = 'none';
        })
    }

    function setActiveTab(el, datasetName) {
        return function (elem) {
            if (elem.classList.contains('active')) {
                elem.classList.remove('active');
            }
            if (el.dataset.tab === elem.dataset[datasetName]) {
                elem.classList.add('active');
            }
        }
    }

    var searchTabs = document.querySelectorAll('.search-page .results-content .tab');
    var searchTabsContent = document.querySelectorAll('.search-page .results-content .content');
    var searchStats = document.querySelectorAll('.search-page .result-stats');

    if (searchTabs.length > 0) {
        searchTabs.forEach(function (el) {
            el.addEventListener('click', function (e) {

                var tabsContentFunc = setActiveTab(el, 'tabContent');
                var tabsStatFunc = setActiveTab(el, 'stat');
                searchTabsContent.forEach(tabsContentFunc)
                searchStats.forEach(tabsStatFunc)
                searchTabs.forEach(function (elem) {
                    if (elem !== el) {
                        if (elem.classList.contains('active')) {
                            elem.classList.remove('active');
                        }
                    } else {
                        if (!elem.classList.contains('active')) {
                            elem.classList.add('active');
                            if(elem.dataset.tab === 'All') {
                                localStorage.setItem('tab', 'all')
                            } else {
                                localStorage.removeItem('tab')
                            }
                        }
                    }
                })
            })
        })
    }

    var searchStatElements = document.querySelectorAll('.search-page .search-section .result-stats');
    var mobileSearchTabs = document.querySelectorAll('.search-page .results-content .mobile-tabs .tab-mobile');
    var mobileSearchTabsSelect = document.querySelector('.search-page .results-content .mobile-tabs');
    var mobileSearchTabsTitle = document.querySelector('.search-page .results-content .mobile-tabs .title');
    var mobileSearchTabsArrow = document.querySelector('.search-page .results-content .mobile-tabs .arrow');

    function openMobileContentSearch(e) {
        e.stopPropagation();
        if (mobileSearchTabsSelect.classList.contains('open')) {
            mobileSearchTabsSelect.classList.remove('open');
            mobileSearchTabsSelect.style.height = '90px';
        } else {
            mobileSearchTabsSelect.classList.add('open');
            var items = mobileSearchTabsSelect.querySelectorAll('div');
            var height = 0;
            items.forEach(function (element) {
                height += element.clientHeight;
            })
            height += 58;
            mobileSearchTabsSelect.style.height = height + 'px';
        }
    }

    if (mobileSearchTabs.length > 0) {
        mobileSearchTabsSelect.addEventListener('click', openMobileContentSearch);
        mobileSearchTabsTitle.addEventListener('click', openMobileContentSearch);
        mobileSearchTabsArrow.addEventListener('click', openMobileContentSearch);

        mobileSearchTabs.forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.stopPropagation();
                if (!el.classList.contains('active')) {
                    mobileSearchTabs.forEach(function (elem) {
                        if (elem.classList.contains('active')) {
                            elem.classList.remove('active');
                        }
                    })
                    if(el.dataset.tab === 'All') {
                        localStorage.setItem('tab', 'all')
                    } else {
                        localStorage.removeItem('tab')
                    }
                    var tabsContentFunc = setActiveTab(el, 'tabContent');
                    searchTabsContent.forEach(tabsContentFunc);
                    var tabsStatFunc = setActiveTab(el, 'stat');
                    searchStatElements.forEach(tabsStatFunc)
                    el.classList.add('active');
                    openMobileContentSearch(e);
                }
            })
        })
    }


////////////////------Observer for You Sign in page after submitting Form------------///////////

    const subscribeForm = document.querySelector('.footer-top form');
    const subsPath = document.querySelector('.redirect-path').dataset.subscribeform;
    console.log(subsPath);

    function showSuccess(mutationsList, observer) {
        mutationsList.forEach((mutation) => {
            if (mutation.target.classList.contains("sent")) {
                subscribeForm.reset();
                localStorage.setItem('pageHeader', document.title);
                location.assign(subsPath);
            }
        });
    }

    const mutationObserver = new MutationObserver(showSuccess);
    mutationObserver.observe(subscribeForm, { attributes: true });

//    Observer for Book Event
    const bookForm = document.querySelector('[data-modal="book"] form');

    function redirectForBook(mutationsList, observer) {
        mutationsList.forEach((mutation) => {
            if(mutation.attributeName === 'data-status'){
                if(mutation.target.wpcf7 && mutation.target.wpcf7.status === 'sent'){
                    window.location.assign(`${currentLocationUrl}/thank-you/`);
                }
            }
        });
    }

    const mutationObserverBook = new MutationObserver(redirectForBook);
    mutationObserverBook.observe(bookForm, { attributes: true });


    const releasesTabs = document.querySelectorAll('.media-press-releases .tabs p');
    const tabsContent = document.querySelectorAll('.media-press-releases .tabs-content [data-type]');

    if(releasesTabs.length > 0){
        releasesTabs.forEach(el=>el.addEventListener('click', e =>{
            releasesTabs.forEach(elem => elem.classList.remove('active'));
            e.target.classList.add('active');
            tabsContent.forEach(elem => elem.classList.remove('active'));
            document.querySelector(`.tabs-content [data-type=${e.target.dataset.type}]`).classList.add('active');

        }));
    }
});

function setLocationInLS(){
    localStorage.setItem('location', 'true');
}
function slider360InitVideoPreview(elememts) {
    if (elememts.length > 0) {
        console.log(elememts)
        elememts.forEach(function (el) {
            el.addEventListener('mouseover', function (event) {
                if (event.currentTarget.classList.contains('swiper-slide')) {
                    var video = el.querySelector('video');
                    video.currentTime = 0;
                    video.play();
                }
            });
            el.addEventListener('mouseout', function (event) {
                if (event.currentTarget === event.target) {
                    var video = el.querySelector('video');
                    video.pause();
                }
            });
            el.addEventListener('touchstart', function (event) {
                if (event.currentTarget.classList.contains('swiper-slide')) {
                    var video = el.querySelector('video');
                    video.currentTime = 0;
                    video.play();
                }
            });
            el.addEventListener('touchend', function (event) {
                if (event.currentTarget === event.target) {
                    var video = el.querySelector('video');
                    video.pause();
                }
            })
        })
    }
}

function touchDragInit(list) {
    // const reversed = list.reverse()
    var items = list.querySelectorAll('.item');
    var startTouchPos = 0;
    var deg = 0;
    items.forEach(function (el, i) {
        var innerContentOpen = el.querySelector('.img .title');
        if (innerContentOpen) {
            innerContentOpen.addEventListener('click', function (e) {
                e.preventDefault();
                var innerContent = el.querySelector('.content-inner').cloneNode( true );
                var modal = document.querySelector('.modal[data-modal="events"]');
                var modalContent = modal.querySelector('.content');
                modalContent.innerHTML = '';
                modalContent.insertAdjacentElement('beforeend', innerContent)
                modal.classList.remove('hidden');
                document.querySelector('body').classList.add('overflow-disabled');
                document.querySelector('html').classList.add('overflow-disabled');
            })
        }
        if (i === items.length - 1) {
            el.classList.remove('next');
        }
        if (el.classList.contains('last-item-mobile')) {
            var newStart = el.querySelector('.btn.btn-hover-anim');
            newStart.addEventListener('click', function (e) {
                e.preventDefault();
                items.forEach(function (elem, index) {
                    // elem.style.zIndex = '1';
                    // elem.style.visibility = 'visible';
                    elem.classList.remove('prev');
                    if (index !== items.length - 1) {
                        elem.classList.add('next');
                    }
                });
            });
            return;
        }
        el.addEventListener('touchstart', function (e) {
            startTouchPos = e.touches[0].clientX;
            deg = 0;
        })
        el.addEventListener('touchend', function (e) {
            el.style.transform = `translateX(0)`;
            startTouchPos = 0;
            if (deg > 3) {
                // el.style.zIndex = '-1';
                // el.style.visibility = 'hidden';
                el.classList.add('prev');
                if (!el.previousElementSibling.classList.contains('last-item-mobile')) {
                    el.previousElementSibling.classList.remove('next');
                }
            }
        })
        el.addEventListener('touchmove', function (e) {
            var percents = Math.abs(startTouchPos - e.touches[0].clientX);
            deg = Math.round(percents / 20);
            if ( percents < 100) {
                if (startTouchPos - e.touches[0].clientX > 0) {
                    el.style.transform = `translateX(${e.touches[0].clientX - startTouchPos}px) rotate(${-deg}deg)`
                } else {
                    el.style.transform = `translateX(${e.touches[0].clientX - startTouchPos}px) rotate(${deg}deg)`
                }
            }
        })
    })

    var arrows = list.querySelectorAll('.nav-arrows [data-arrow]');
    arrows.forEach(function (el) {
        el.addEventListener('click', function (e) {
            var elem = null;
            items.forEach(function (item) {
                if (!item.classList.contains('prev') && !item.classList.contains('next')) {
                    elem = item;
                }
            })
            if (elem) {
                if (el.dataset.arrow === 'right') {
                    elem.classList.add('prev');
                    if (!elem.previousElementSibling.classList.contains('last-item-mobile')) {
                        elem.previousElementSibling.classList.remove('next');
                    }
                } else if (el.dataset.arrow === 'left') {
                    if (!elem.nextElementSibling.classList.contains('nav-arrows')) {
                        elem.classList.add('next');
                        if (!elem.nextElementSibling.classList.contains('last-item-mobile')) {
                            elem.nextElementSibling.classList.remove('prev');
                        }
                    }
                }
            }
        })
    })
}

function modalLocationInit() {
    var modalButtonsOpen = document.querySelectorAll('[data-modal-name="locations"]');

    if (modalButtonsOpen.length > 0) {
        modalButtonsOpen.forEach(function (el) {
            el.addEventListener('click', function () {
                var modal = document.querySelector(`[data-modal="${el.dataset.modalName}"]`);
                modal.classList.remove('hidden');
            })
        })
    }

    var modals = document.querySelectorAll('[data-modal]');

    if (modals.length > 0) {
        modals.forEach(function (el) {
            var closeBtn = el.querySelector('.modal-close');
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector('body').classList.remove('overflow-disabled');
                document.querySelector('html').classList.remove('overflow-disabled');
                el.classList.add('hidden');
                let attr = el.getAttribute('data-modal');
                if(attr === 'book'){
                    let curLink = window.location.href.replace('?book-a-party=yes', '');
                    history.pushState(null, null, curLink);
                }else if(attr === 'locations'){
                    let locationBtnText = document.getElementById('location-btn').textContent.trim().toLowerCase();
                    let allLabels = document.querySelectorAll('[data-modal="locations"] label');
                    allLabels.forEach(function (el){
                        let elText = el.querySelector('.name').textContent.toLowerCase(),
                            input = el.querySelector('input');
                        if(elText.indexOf(locationBtnText) !== -1){
                            el.classList.add('checked');
                            input.checked = true;
                        }else{
                            el.classList.remove('checked');
                            input.checked = false;
                        }
                    });
                }
            })
        })
    }
}

function moreInfoBlockInit() {
    var playMoreInfoContents = document.querySelectorAll('.what-we-have .content-section.desktop-only .item .item-content');

    if (playMoreInfoContents.length > 0) {
        moreInfoContainerInit();
        playMoreInfoContents.forEach(function (el) {
            var item = el.closest('.item');
            var containerMoreInfo = getNextSiblingWithClassName(item, 'more-info');

            containerMoreInfo.insertAdjacentElement('beforeend', el);
        })
    }

    function getNextSiblingWithClassName(item, className) {
        var isFind = true;
        var count = 0;
        var selectedSibling = item.nextElementSibling;

        while (isFind) {
            if (count > 10) return;
            if (selectedSibling.classList.contains(`${className}`)) {
                return selectedSibling;
            } else {
                selectedSibling = selectedSibling.nextElementSibling;
            }
            count++;
        }
    }

    var playListItems = document.querySelectorAll('.what-we-have .content-section.desktop-only [data-item]');
    var closeExpandedInfoButtons = document.querySelectorAll('.what-we-have .content-section.desktop-only [data-item-content] .close');

    if (playListItems.length > 0) {
        playListItems.forEach(function (el) {
            var title = el.querySelector('.title');
            title.addEventListener('click', function (e) {
                var section = el.closest('.content-section.desktop-only');
                var moreInfoContent = section.querySelector(`[data-item-content='${el.dataset.item}']`);

                closeExpandedInfoButtons.forEach(function (elem) {
                    closeExpandedPlayInfo(elem);
                })
                if (!moreInfoContent) return;

                el.classList.add('expanded');
                moreInfoContent.classList.remove('hidden');
            })
        })
    }

    if (closeExpandedInfoButtons.length > 0) {
        closeExpandedInfoButtons.forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                closeExpandedPlayInfo(el);
            })
        })
    }
}

function moreInfoContainerInit() {
    var playSectionItems = document.querySelectorAll('.what-we-have .content-section.desktop-only .item');

    if (playSectionItems.length > 0) {
        var pasteAfter = 3;
        if (window.matchMedia('(max-width: 600px)').matches) {
            pasteAfter = 1;
        } else if (window.matchMedia('(max-width: 991px)').matches) {
            pasteAfter = 2;
        }

        var counter = pasteAfter;
        playSectionItems.forEach(function (el, i) {
            if (counter > playSectionItems.length) {
                counter = playSectionItems.length;
            }
            if (i === counter - 1) {
                var moreInfo = document.createElement('div');
                moreInfo.classList.add('more-info');
                el.parentNode.insertBefore(moreInfo, el.nextSibling);
                counter += pasteAfter;
            }
        })

    }
}

function closeExpandedPlayInfo(el) {
    var moreInfoContent = el.closest('[data-item-content]');
    var activeItem = el.closest('.content-section').querySelector(`[data-item='${moreInfoContent.dataset.itemContent}']`);
    var moreInfoContainer = el.closest('.more-info');

    moreInfoContent.classList.add('hidden');
    activeItem.classList.remove('expanded');
    moreInfoContainer.classList.remove('expanded');
}

function changeActivePos(el, list, datasetName) {
    if (el.dataset[datasetName] === '1') return;
    switch (el.dataset[datasetName]) {
        case '2':
            list.forEach(function (element) {
                switch (element.dataset[datasetName]) {
                    case '1':
                        element.dataset[datasetName] = '2';
                        break;
                }
            })
            el.dataset[datasetName] = '1';
            break;
        case '3':
            list.forEach(function (element) {
                switch (element.dataset[datasetName]) {
                    case '2':
                        element.dataset[datasetName] = '3'
                        break;
                    case '1':
                        element.dataset[datasetName] = '2';
                        break;
                }
            })
            el.dataset[datasetName] = '1';
            break;
    }
}

function setActiveClass() {
    var elems = document.querySelectorAll(`.home-page .special-events [data-pos]`);
    elems.forEach(function (el) {
        if (el.dataset.pos === '1') {
            if (!el.classList.contains('active')) {
                el.classList.add('active');
            }
        } else {
            if (el.classList.contains('active')) {
                el.classList.remove('active');
            }
        }
    })
}

function mobileMenuInit() {
    var menuOpenBtn = document.querySelector('.nav-mobile .logo-mobile .menu');

    menuOpenBtn.addEventListener('click', function (e) {
        e.preventDefault();
        var container = menuOpenBtn.closest('.nav-mobile');
        document.body.classList.add('overflow-disabled');
        container.classList.add('open');
    })
    var menuSearchOpenBtn = document.querySelector('.nav-mobile .logo-mobile .menu-search');

    menuSearchOpenBtn.addEventListener('click', function (e) {
        e.preventDefault();
        var container = menuSearchOpenBtn.closest('.nav-mobile');
        var input = container.querySelector('form input');
        document.body.classList.add('overflow-disabled');
        container.classList.add('open');
        input.focus();
    })

    var menuCloseBtn = document.querySelector('.nav-mobile .close-container .close');

    menuCloseBtn.addEventListener('click', function (e) {
        e.preventDefault();
        var container = menuCloseBtn.closest('.nav-mobile');
        document.body.classList.remove('overflow-disabled');
        container.classList.remove('open');
    })

    var menuListTitles = document.querySelectorAll('.nav-mobile .links-list .title');

    menuListTitles.forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            var container = el.closest('.link-title');

            if (container.classList.contains('open')) {
                container.classList.remove('open');
                container.style.height = '25px';
            } else {
                var innerContent = container.querySelector('.inner-content');
                container.classList.add('open');
                container.style.height = innerContent.clientHeight + 25 + 'px';
            }
        })
    })
}

function foodAndEatInit() {
    const productItems = document.querySelectorAll('.products-types .item');
    if (productItems.length > 0) {
        productItems.forEach(el => {
            el.addEventListener('mouseover', e=>{
                productItems.forEach(item => item.classList.remove('active'));
                e.target.closest('.item').classList.add('active')
            })
        });
    }
}

window.addEventListener('hashchange', function(){
    var closeExpandedInfoButtons = document.querySelectorAll('.what-we-have .content-section.desktop-only [data-item-content] .close');
    closeExpandedInfoButtons.forEach(function (el) {
        closeExpandedPlayInfo(el);
    });
    openCards();
    var container = document.querySelector('header .nav-mobile');
    document.body.classList.remove('overflow-disabled');
    container.classList.remove('open');
});

function openCards() {
    const url = window.location.href.split('#');
    if (url.length > 1) {
        const element = document.getElementById(`${url.pop()}`);
        if (element) {
            if( window.matchMedia('(max-width: 600px)').matches) {
                const itemArr =
                    document.querySelectorAll('.mobile-only .item').length > 0 ?
                        document.querySelectorAll('.mobile-only .item') :
                        document.querySelectorAll('.mobile-list .item');
                if (itemArr.length > 0) {
                    for(let i = itemArr.length; i > 0; i--) {
                        if(itemArr[i]) {
                            if( itemArr[i].id === element.id){
                                itemArr[i].scrollIntoView({behavior: "smooth", block: "center"});
                                var innerContentOpen = itemArr[i].querySelector('.img .title');
                                if (innerContentOpen) {
                                    var innerContent = itemArr[i].querySelector('.content-inner').cloneNode( true );
                                    var modal = document.querySelector('.modal[data-modal="events"]');
                                    var modalContent = modal.querySelector('.content');
                                    modalContent.innerHTML = '';
                                    modalContent.insertAdjacentElement('beforeend', innerContent)
                                    modal.classList.remove('hidden');
                                }
                                break;
                            }

                        }
                    }
                }
            } else {
                const desktopPlay = document.querySelector(`[data-item-content="${element.dataset.item}"]`);
                if(desktopPlay) {
                    element.classList.add('expanded');
                    desktopPlay.classList.remove('hidden');
                }
                const elem = element.querySelector('.accordion');
                if (elem) {
                    elem.classList.add('open');
                    const inContent = element.querySelector('.content');
                    elem.style.height = inContent.clientHeight + 'px';
                }
            }
        }
    }
}


