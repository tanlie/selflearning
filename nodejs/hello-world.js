const http = require('http');

const hostname = '127.0.0.1';
const port = 3000;

const serrver = http.createServer((req,res)=>{
    res.statusCode = 200;
    res.setHeader('Content-Type','text/plain');
    res.end('hello,world!\n');
});

serrver.listen(port,hostname,()=>{
    console.log('running successfully');
});