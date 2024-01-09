const loginBtn = document.getElementById('login-btn');

loginBtn.addEventListener('click', (event) => {
  event.preventDefault();
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  if (username === 'user1' && password === 'pass1') {
    location.assign('Main Page.html');
  } else {
    alert('Invalid username or password');
  }
});

function myfunction1(){
    song1 = "False Knight";
    let userinput=document.querySelector("#search-input").value;
    if(String(userinput).toLowerCase()==song1.toLowerCase()) location.assign('vinyl1.html');
    if(String(userinput).toLowerCase()=="People's Instinctive Travels and the Paths of Rhythm".toLowerCase()) location.assign('vinyl2.html');
    if(String(userinput).toLowerCase()=="Midnight Marauders".toLowerCase()) location.assign('vinyl3.html');
    if(String(userinput).toLowerCase()=="Beats, Rhymes and Life".toLowerCase()) location.assign('vinyl4.html');
    if(String(userinput).toLowerCase()=="we got it from here".toLowerCase()) location.assign('vinyl5.html');

  }
// ...

function createSongElement(song) {
  var songElement = document.createElement('div');
  songElement.className = 'song';

  var playButton = document.createElement('button');
  playButton.textContent = 'Play';
  playButton.addEventListener('click', function () {
      // Update the audio source and play
      playSelectedSong(song.filePath);
  });

  var addButton = document.createElement('button');
  addButton.textContent = 'Add';
  addButton.addEventListener('click', function () {
      // Implement add logic using song.filePath
  });

  var titleElement = document.createElement('p');
  titleElement.textContent = 'Title: ' + song.title;

  var artistElement = document.createElement('p');
  artistElement.textContent = 'Artist: ' + song.artist;

  songElement.appendChild(titleElement);
  songElement.appendChild(artistElement);
  songElement.appendChild(playButton);
  songElement.appendChild(addButton);

  return songElement;
}