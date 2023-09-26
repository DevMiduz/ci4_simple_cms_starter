var app = app || {};

app.delete_link_submit = function(event, element) {
    

    if(confirm('Do you wish to delete this item?')) {
        event.preventDefault();
        const xhttp = new XMLHttpRequest();

        xhttp.onload = function(xhr_event) {
            window.location.reload();
        }

        xhttp.onerror = function(xhr_event) {
            window.location.reload();
        }

        //xhttp.open('POST', "/tags/delete/10");
        xhttp.open('POST', element.getAttribute("href"));
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('csrf_test_name=' + document.querySelector("meta[name='X-CSRF-TOKEN']").content);
    } else {

    }
    event.preventDefault();
}

/*
    could attach the event to the table itself and propagate the events up to it.
*/