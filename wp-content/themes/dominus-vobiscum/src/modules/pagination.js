import $ from "jquery";

class ajaxPaginate {
    constructor() {
        this.events();
    }
    events() {
        $(document).ready(() => {
            // Perbaiki selector untuk menangkap event pagination
            $(document).on('click', '#paginationAjax a', (e) => {
                e.preventDefault();
                var link = $(e.currentTarget).attr('href');
                history.pushState(null, null, link);
                
                // Animasi scroll
                $('html, body').stop(true).animate({ scrollTop: 0 }, {
                    duration: 500,
                    easing: 'swing',
                    complete: () => {
                        this.loadPosts(link);
                    }
                });
            });
        });
    }

    loadPosts(link) {
        $.ajax({
            url: link,
            type: 'GET',
            beforeSend: () => {
                // Placeholder untuk post
                var placeholderHtml = `
                <div class="col-lg-4 col-md-6 mb-3">
                    <article class="card h-100 border-0 skel" style="width: 100%;">
                        <div style="height: 200px; overflow: hidden; border-radius: 1vw; position: relative;">
                            <div class="skel-image" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;"></div>
                        </div>
                        <div class="card-body px-0">
                            <div class="mb-2" style="display: flex; flex-wrap: wrap; gap: 5px;">
                                <div class="skeleton" style="height: 1.25rem; width: 10%; border-radius: 0.25rem;"></div>
                                <div class="skeleton" style="height: 1.25rem; width: 20%; border-radius: 0.25rem;"></div>
                                <div class="skeleton" style="height: 1.25rem; width: 10%; border-radius: 0.25rem;"></div>
                            </div>
                            <h2 class="card-title h5 skeleton" style="height: 1.5rem; margin-bottom: 0.5rem; width: 60%;"></h2>
                            <div class="d-flex align-items-center my-3">
                                <div class="skeleton" style="width: 25px; height: 25px; border-radius: 50%;"></div>
                                <div class="mx-2 skeleton" style="height: 1rem; width: 30%;"></div>
                            </div>
                            <div class="card-text skeleton" style="height: 1rem; margin-bottom: 0.5rem; width: 100%;"></div>
                            <div class="card-text skeleton" style="height: 1rem; margin-bottom: 0.5rem; width: 100%;"></div>
                            <div class="card-text skeleton" style="height: 1rem; margin-bottom: 0.5rem; width: 100%;"></div>
                            <div class="card-text skeleton" style="height: 1rem; width: 60%;"></div>
                        </div>
                    </article>
                </div>`;

                $('#postAjax').html(placeholderHtml.repeat(6));
            },
            success: (response) => {
                setTimeout(() => {
                    // Parse response HTML
                    const $response = $('<div>').html(response);
                    
                    // Update konten artikel
                    const newPosts = $response.find('#postAjax').html();
                    $('#postAjax').html(newPosts);
                    
                    // Update konten pagination
                    const newPagination = $response.find('#paginationAjax').html();
                    $('#paginationAjax').html(newPagination);
                    
                    // Update jumlah artikel yang ditampilkan
                    const articleCount = $response.find('.entry-content > p').first().text();
                    $('.entry-content > p').first().text(articleCount);
                }, 1500);
            },
            error: (jqXHR, textStatus, errorThrown) => {
                console.error('An error occurred:', {
                    status: jqXHR.status,
                    statusText: jqXHR.statusText,
                    responseText: jqXHR.responseText,
                    textStatus: textStatus,
                    errorThrown: errorThrown
                });
            }
        });
    }
}

export default ajaxPaginate;