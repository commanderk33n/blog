/**
 * Project: blog
 * File:
 * User: commanderk33n
 * Date: 10.10.15
 * Time: 22:41
 */

function delpost(id, title) {
    if(confirm("Are you sure you want to delete '"+ title +"'")) {
        window.location.href = 'index.php?delpost=' +id;
    }
}
