function toast(title, message, type, duration, src) {
    const main = document.getElementById('toast');
    if (main) {

        const toast = document.createElement('div');
        const delay = (duration / 1000).toFixed(2);

        toast.classList.add('toasts', `toast-${type}`);
        toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${delay}s forwards`;


        setTimeout(function () {
            main.removeChild(toast);
        }, duration + 1000);

        toast.onclick = function (e) {
            if (e.target.closest('.toast-close')) {
                main.removeChild(toast);
            } else {
                window.location = src;
            }
        };
        toast.innerHTML = `
            <div class="toast-icon"">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <div class="toast-body">
                <h3 class="toast-title">
                    ${title}
                </h3>
                <p class="toast-msg">
                    ${message}
                </p>
            </div>
            <div class="toast-close"><i class="fa fa-times" aria-hidden="true"></i></div>
        `;
        main.appendChild(toast);
    }
}

$("#notice").on('click', function () {
    $("#notice-box").toggle("slow");
    $("#avatar-box").css("display", "none");
});

$("#avatar").on('click', function () {
    $("#avatar-box").toggle("slow");
    $("#notice-box").css("display", "none");
});

function createNoticeItemBox(id, title, message, type, src, viewed) {
    const main = document.getElementById('notice-box');
    if (main) {
        const toast = document.createElement('div');

        toast.addEventListener("click", function () {
            noticeViewed(id);
            window.location = src;
        });

        toast.classList.add('toasts', `toast-${type}`, 'notice-item');
        if (viewed == false) {
            toast.classList.add('toast-viewed');
        }
        toast.innerHTML = `
            <div class="toast-icon"">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <div class="toast-body">
                <h3 class="toast-title">
                    ${title}
                </h3>
                <p class="toast-msg">
                    ${message}
                </p>
            </div>
        `;
        main.appendChild(toast);
    }
}

function createNotice(title, message, type, duration, src) {
    toast(title, message, type, duration, src);
    createNoticeItemBox(0, title, message, type, src, false);
}


