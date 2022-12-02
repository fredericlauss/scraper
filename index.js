const xpath = require("xpath-html");
var fs = require('fs');


const getPages = async () => {
    for (let i = 1; i < 9; i++) {
        linkstest = 'http://vps-a47222b1.vps.ovh.net:8484/Product/page/' + i;
        getLinks(linkstest);
      }
};
const elFetchor = async (pageToFetch) => {
  try {
    const response = await fetch(pageToFetch);
    const body = await response.text();
    const element = xpath.fromPageSource(body);
    return element;
  } catch (error) {
    console.error(error);
  }
}

const getProductContent = async (link) => {
  let objectList = [];
  element = await elFetchor(link);
  const xpathtitle = element.findElement("//h1");
  const title = xpathtitle.getText();
  const xpathdescription = element.findElement("//div[@class='p-1']/p");
  const description = xpathdescription.getText();
  const xpathpricedescription = element.findElement("//h3/span");
  const priceDescription = xpathpricedescription.getText();
  const xpathprice = element.findElement("//h3");
  const price = xpathprice.getText();
  const xpathimg = element.findElement("//div[@class='d-flex']/img");
  const img = xpathimg.getAttribute("src");
  console.log(title, description, priceDescription, price, img);
};

const creatJson = async (object) => {
  fs.writeFile('titleScrap.json', json, (err) => {
    if (err)
      console.log(err);
  });
}


const getLinks = async (linkPage) => {
  element = await elFetchor(linkPage);
  const node = element.findElements("//a[@class='btn btn-primary'][starts-with(@href, '/product/')]");
  let i = 0;
  node.forEach(function() { 
  const href = node[i++].getAttribute("href");
  const link = "http://vps-a47222b1.vps.ovh.net:8484" + href;
  getProductContent(link); 
});
};

getPages();

