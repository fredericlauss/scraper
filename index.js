const cheerio = require('cheerio');
var fs = require('fs');

objectsList = [];

const getPages = async () => {
    for (let i = 1; i < 9; i++) {
        linkstest = 'http://vps-a47222b1.vps.ovh.net:8484/Product/page/' + i;
        getLinks(linkstest);
      }
};

const getContent = async (link) => {
  const objectList = [];
  const response = await fetch(link);
  const body = await response.text();

  const $ = cheerio.load(body);

  $('.display-4').each((i, title) => {
    const titleNode = $(title);
    const titleText = titleNode.text();
    objectList.push(titleText);
  });

  $("img").each( function () {
    var img = $(this).attr('src');
    objectList.push(img);
    console.log(objectList);
 });

//  var price = $("h3").text();
//  objectList.push(price);
  objectsList.push(objectList);
  var json = JSON.stringify(objectsList);
  fs.writeFile('titleScrap.json', json, (err) => {
    if (err)
      console.log(err);
  });
};

const getLinks = async (linkPage) => {
  // get html text from site
  const response = await fetch(linkPage);
  // using await to ensure that the promise resolves
  const body = await response.text();

  const $ = cheerio.load(body);

  $('.btn-primary').each( function () {
    var link = 'http://vps-a47222b1.vps.ovh.net:8484' + $(this).attr('href');
    getContent(link);
 });

};



getPages();

