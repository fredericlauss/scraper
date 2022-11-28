const cheerio = require('cheerio');
var fs = require('fs');


const links = [];

const getPages = async () => {
    for (let i = 1; i < 9; i++) {
        linkstest = 'http://vps-a47222b1.vps.ovh.net:8484/Product/page/' + i;
        getLinks(linkstest);
        console.log(linkstest);
      }
};

const getLinks = async (linkPage) => {
  // get html text from site
  const response = await fetch(linkPage);
  console.log(linkPage);
  // using await to ensure that the promise resolves
  const body = await response.text();

  const $ = cheerio.load(body);

  $('.btn-primary').each( function () {
    var link = $(this).attr('href');
    links.push({link});
 });

  var json = JSON.stringify(links);
  fs.writeFile('resultScrap.json', json, (err) => {
    if (err)
      console.log(err);
  });
};


getPages();