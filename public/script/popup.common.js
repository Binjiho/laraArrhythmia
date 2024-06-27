$(document).on('click', '.popup_close_btn', function() { // 메인 팝업 닫기
    const id = $(this).closest('.mainPopupLayer').attr('id');
    const popupYN= $('#' + id).find('input[name=popup_yn]:checked').val();

    if(!isEmpty(popupYN)) {
        if(popupYN === 'today') {
            const value = 'done';
            const expiredays = 1;

            setCookie24(id, value, expiredays); // 24 시간
            // setCookie00(id, value, expiredays); // 00 시 기준
        }

        if(popupYN === 'week') {
            const value = 'done';
            const expiredays = 7;

            setCookie24(id, value, expiredays); // 24 * 7 시간
            // setCookie00(id, value, expiredays); // 00 시 기준
        }
    }

    $('#' + id).remove();
});

$(document).on('click', '.popup_close_btn', function() {
    const id = $(this).closest('.pop-layer').attr('id');
    if($("input[name='popup_yn']:checked").length > 0) {
        if($("input[name='popup_yn']").val() === 'Y') {
            const value = 'done';
            const expiredays = 1;

            setCookie24(id, value, expiredays); // 24 시간
            // setCookie00(id, value, expiredays); // 00 시 기준
        }
    }
    $('#popup_' + $(this).data('sid')).remove();
});

// 24시간 기준 쿠키 설정하기
// expiredays 후의 클릭한 시간까지 쿠키 설정
const setCookie24 = (name, value, expiredays) => {
    let todayDate = new Date();
    todayDate.setDate(todayDate.getDate() + expiredays);
    document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";";
}

// 00:00 시 기준 쿠키 설정하기
// expiredays 의 새벽 00:00:00 까지 쿠키 설정
const setCookie00 = (name, value, expiredays) => {
    let todayDate = new Date();
    todayDate = new Date(parseInt(todayDate.getTime() / 86400000) * 86400000 + 54000000);

    if (todayDate > new Date()) {
        expiredays = expiredays - 1;
    }

    todayDate.setDate(todayDate.getDate() + expiredays);
    document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";";
}

// 쿠키 가져오기
function getCookie(name) {
    var nameOfCookie = name + "=";
    var x = 0;
    while (x <= document.cookie.length) {
        var y = (x + nameOfCookie.length);

        if (document.cookie.substring(x, y) == nameOfCookie) {
            if ((endOfCookie = document.cookie.indexOf(";", y)) == -1)
                endOfCookie = document.cookie.length;
            return unescape(document.cookie.substring(y, endOfCookie));
        }

        x = document.cookie.indexOf(" ", x) + 1;

        if (x == 0) break;
    }

    return "";
}