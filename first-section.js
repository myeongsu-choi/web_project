let files = [
    "http://localhost/project/images/KD17.png", 
    "http://localhost/project/images/Book 1 'Rattlesnake'.png",
    "http://localhost/project/images/Nike Air Max Dn.png",
    "http://localhost/project/images/Ja 1.png",
    "http://localhost/project/images/Nike Air More Uptempo '96.png",
    "http://localhost/project/images/Nike G.T. Hustle 2.png",
    "http://localhost/project/images/Nike Air Max 90.png",
    "http://localhost/project/images/Nike Calm.png"
];
let encodedFiles = files.map(file => {
    let parts = file.split('/');
    let encodedParts = parts.map(part => encodeURIComponent(part));
    return encodedParts.join('/');
});

console.log(encodedFiles);


let names = [
    "KD17",
    "Book 1 \"Rattlesnake\"",
    "Nike Air Max Dn",
    "Ja 1",
    "Nike Air More Uptempo '96",
    "Nike G.T. Hustle 2",
    "Nike Air Max 90",
    "Nike Calm"
];

let link = [
    'product.php?id=p01',
    'product.php?id=p02',
    'product.php?id=p03',
    'product.php?id=p04',
    'product.php?id=p05',
    'product.php?id=p06',
    'product.php?id=p07',
    'product.php?id=p08'
]

let prices = [
    "price : $150", "price : $140", "price : $160", "price : $120", "price : $180", "price : $170", "price : $130", "price : $50"
];

let imgs = new Array(); 
for(let i=0; i<files.length; i++) {
    imgs[i] = new Image(); 
    imgs[i].src = files[i];
}

let next = 3;
function nextChange() {
    let imgElements0 = document.getElementById("productImage0");
    let imgElements1 = document.getElementById("productImage1");
    let imgElements2 = document.getElementById("productImage2");
    let nameElements0 = document.getElementById("name0");
    let nameElements1 = document.getElementById("name1");
    let nameElements2 = document.getElementById("name2");
    let priceElements0 = document.getElementById("price0");
    let priceElements1 = document.getElementById("price1");
    let priceElements2 = document.getElementById("price2");

    imgElements0.src = imgs[next].src; 
    nameElements0.innerText = names[next];
    priceElements0.innerText = prices[next];
    document.getElementById("link0").href = link[next];
    next++;
    next %= imgs.length; 

    imgElements1.src = imgs[next].src; 
    nameElements1.innerText = names[next];
    priceElements1.innerText = prices[next];
    document.getElementById("link1").href = link[next];
    next++;
    next %= imgs.length; 

    imgElements2.src = imgs[next].src; 
    nameElements2.innerText = names[next];
    priceElements2.innerText = prices[next];
    document.getElementById("link2").href = link[next];
    next++; 
    next %= imgs.length; 

    prev = (next + 2) % imgs.length;
}

let prev = 5;
function previousChange() {
    let imgElements0 = document.getElementById("productImage0");
    let imgElements1 = document.getElementById("productImage1");
    let imgElements2 = document.getElementById("productImage2");
    let nameElements0 = document.getElementById("name0");
    let nameElements1 = document.getElementById("name1");
    let nameElements2 = document.getElementById("name2");
    let priceElements0 = document.getElementById("price0");
    let priceElements1 = document.getElementById("price1");
    let priceElements2 = document.getElementById("price2");
    
    imgElements0.src = imgs[prev].src; 
    nameElements0.innerText = names[prev];
    priceElements0.innerText = prices[prev];
    document.getElementById("link0").href = link[prev];
    prev++;
    prev %= imgs.length; 

    imgElements1.src = imgs[prev].src; 
    nameElements1.innerText = names[prev];
    priceElements1.innerText = prices[prev];
    document.getElementById("link1").href = link[prev];
    prev++;
    prev %= imgs.length; 

    imgElements2.src = imgs[prev].src; 
    nameElements2.innerText = names[prev];
    priceElements2.innerText = prices[prev];
    document.getElementById("link2").href = link[prev];
    prev++; 
    prev %= imgs.length; 

    next = prev % imgs.length;
    prev = (prev + 2) % imgs.length;
}