const xpath = require("xpath-html");
var fs = require('fs');

let objectsList = [];

const getPages = async () => {
    for (let i = 1; i < 9; i++) {
        linkstest = 'http://vps-a47222b1.vps.ovh.net:8484/Product/page/' + i;
        getLinks(linkstest);
      }
};

const getProductContent = async (link) => {
  let objectList = [];
  const response = await fetch(link);
  const body = await response.text();
  console.log(body);
//   const $ = cheerio.load(body);

//   $('.display-4').each((i, title) => {
//     const titleNode = $(title);
//     const titleText = titleNode.text();
//     return titleText;
//   });

//   $("img").each( function () {
//     var img = $(this).attr('src');
//     return img;
//  });

//  objectsList.push(objectList);
//  var json = JSON.stringify(objectsList, null, 4);
//  console.log(json);
//  fs.writeFileSync('titleScrap.json', json );
};

const creatJson = async (object) => {
  fs.writeFile('titleScrap.json', json, (err) => {
    if (err)
      console.log(err);
  });
}


const getLinks = async (linkPage) => {
  const response = await fetch(linkPage);
  const body = await response.text();
  const node = xpath.fromPageSource(body).findElement("//a[@class='btn btn-primary'][starts-with(@href, '/product/')]");
  const href = node.getAttribute("href");
  const link = "http://vps-a47222b1.vps.ovh.net:8484" + href;
  getProductContent(link);

};

getPages();

