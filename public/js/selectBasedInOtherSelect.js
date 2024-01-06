let urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];

//get select path
export default function getSelectorBasedInOther(data, urlAjaxPath) {
    // $(idSelector).html(data)
    return new Promise((resolve, reject) => {
        var url = "/" + lang + "/" + urlAjaxPath;
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            headers:
                {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            success: function (data) {
                // $(idSelector).html(data)
                resolve(data);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
}
