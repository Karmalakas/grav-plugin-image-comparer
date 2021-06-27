const imageComparer = (selector) => {
    const wrappers = document.querySelectorAll(selector);

    for (let i = 0; i < wrappers.length; i++) {
        init(wrappers[i]);
    }

    function init(wrapper) {
        let active = false;
        const scrollerBefore = wrapper.querySelector('.scroller-before');
        const scrollerAfter = wrapper.querySelector('.scroller-after');

        wrapper.addEventListener('mouseup', listenEndActive);
        wrapper.addEventListener('mouseleave', listenEndActive);
        wrapper.addEventListener('touchend', listenEndActive);
        wrapper.addEventListener('touchcancel', listenEndActive);
        wrapper.addEventListener('mousemove', listenMove);
        wrapper.addEventListener('touchmove', listenMove);

        scrollerBefore.addEventListener('mousedown', listenStartActive);
        scrollerBefore.addEventListener('touchstart', listenStartActive);
        scrollerAfter?.addEventListener('mousedown', listenStartActive);
        scrollerAfter?.addEventListener('touchstart', listenStartActive);

        function listenStartActive(e) {
            active = e.target.dataset.activeLabel;
            e.target.classList.add('scrolling');
        }

        function listenEndActive() {
            active = false;
            scrollerBefore.classList.remove('scrolling');
            scrollerAfter?.classList.remove('scrolling');
        }

        function listenMove(e) {
            if (!active) {
                return;
            }

            e.preventDefault();

            let x = e.touches?.length > 0 ? e.touches[0].pageX : e.pageX;
            x -= wrapper.getBoundingClientRect().left;

            scrollIt(x);
        }

        function scrollIt(x) {
            const wrapperWidth = wrapper.offsetWidth;
            const transform = Math.min(100, (((Math.max(0, (Math.min(x, wrapperWidth)))) * 100) / wrapperWidth)) + '%';

            updateProperty(active, transform);

            if (scrollerAfter && scrollerBefore.getBoundingClientRect().left > scrollerAfter.getBoundingClientRect().left) {
                let property = active === 'before' ? 'after' : 'before';
                updateProperty(property, transform);
            }
        }

        function updateProperty(property, value) {
            wrapper.style.setProperty('--scroller-' + property + '-position', value);
        }
    }
};
