const xpath = require("xpath-html");
var fs = require('fs');

const getPages = () => {
  links = [];
    for (let i = 1; i < 9; i++) {
        links.push('http://vps-a47222b1.vps.ovh.net:8484/Product/page/' + i);
      }
      return links;
};

const elFetchor = async (pageToFetch) => {
  try {
    const response = await fetch(pageToFetch);
    const body = await response.text();
    const document = xpath.fromPageSource(body);
    return document;
  } catch (error) {
    console.error(error);
  }
}

const getLinks = async () => {
  const pages = getPages();
  let allLinks = [];
  for (const page of pages) {
    const document = await elFetchor(page);
    const links = document.findElements("//a[@class='btn btn-primary'][starts-with(@href, '/product/')]");
    const linkss = links.map(link=>link.getAttribute("href"));
    allLinks = [...allLinks,...linkss];
  }
  return allLinks;
};

const getProductContent = async () => {
  const links = await getLinks();
  let allContent = [];
  for (const link of links) {
    const documentlink = "http://vps-a47222b1.vps.ovh.net:8484" + link;
    document = await elFetchor(documentlink);
    const xpathtitle = document.findElement("//h1");
    const title = xpathtitle.getText();
    const xpathdescription = document.findElement("//div[@class='p-1']/p");
    const description = xpathdescription.getText();
    const xpathpricedescription = document.findElement("//h3/span");
    const priceDescription = xpathpricedescription.getText();
    const xpathprice = document.findElement("//h3");
    const price = xpathprice.getText().trim();
    const xpathimg = document.findElement("//div[@class='d-flex']/img");
    const img = xpathimg.getAttribute("src");
    const object =  {
      title,
      description,
      priceDescription,
      price,
      img
    };
    allContent.push(object);
  }
  return allContent;
};

const creatJson = async () => {
  const allContent = await getProductContent();
  fs.writeFile('data.json', JSON.stringify(allContent), (err) => {
    if (err)
      console.log(err);
  });
}

creatJson();