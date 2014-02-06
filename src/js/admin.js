function tomain()
{
    window.self.location = '../html/main.html'
}
function logout()
{
    window.self.location = '../php/logout.php';
}
function clearfield()
{
    document.getElementById('updatetitle').value = '';
    document.getElementById('updatebody').value = '';
}