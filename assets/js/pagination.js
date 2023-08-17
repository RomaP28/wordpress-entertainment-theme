function paginationInit() {
    const tabs_content = document.querySelectorAll('.tabs-content [data-type]');
    const per_page = 10;

    if(tabs_content.length > 0){
        tabs_content.forEach(el => {
            const items = el.querySelectorAll('.media-item');
            const pagination = el.querySelector('.pagination');
            const pages = el.querySelector('.pages');
            const next_prev = el.querySelectorAll('span.prev, span.next');
            const amount_pages = Math.ceil(items.length / per_page);
            let active_page = 1;

            if(items.length <= per_page){
                pagination.classList.add('hidden');
            } else {
                for(let i = 1; i <= amount_pages; i++){
                    pages.insertAdjacentHTML("beforeend", `<span class="${active_page === i?'active':''}" data-page=${i}>${i}</span>`)
                }
                items.forEach((el, i)=> {
                    if((i + 1) > per_page){
                        el.classList.add('hidden');
                    }
                });

                next_prev.forEach(elem=> {
                    elem.addEventListener('click', e=>{
                        el.querySelector(`.pages [data-page="${e.target.dataset.arrow === 'prev'? active_page - 1 : active_page + 1}"]`).click();
                    })
                });

                display_next_prev(active_page);

                const pages_num = pages.querySelectorAll('span');
                pages_num.forEach(elem => elem.addEventListener('click', e => {
                    active_page = +e.target.dataset.page;
                    const start_pos = active_page <= 1 ? 1 : per_page * (active_page - 1) + 1;
                    const end_pos = start_pos + (per_page - 1);

                    pages_num.forEach(element => element.classList.remove('active'));
                    e.target.classList.add('active');

                    items.forEach((element, index) => {
                        element.classList.add('hidden');
                        if((index + 1) >= start_pos && (index + 1) <= end_pos){
                            element.classList.remove('hidden');
                        }
                    });
                    display_next_prev(active_page);
                }))
            }

            function display_next_prev(active){
                if(active === 1){
                    next_prev.forEach((elem, i) => elem.classList[`${i === 0?'add':'remove'}`]('invisible'));
                } else if(active === amount_pages){
                    next_prev.forEach((elem, i) => elem.classList[`${i === 1?'add':'remove'}`]('invisible'));
                } else{
                    next_prev.forEach(elem=> elem.classList.remove('invisible'));
                }
            }
        });
    }
}
