const https = require('https')
var 

const options = {
    hostname: 'www.random.org',
    port: 443,
    path: '/integers/?num=1&min=1&max=10&col=1&base=10&format=plain&rnd=new',
    method: 'GET'
}

const req = https.request(options, res => {

    res.on('data', d => {
        process.stdout.write(d)
    })
})

req.on('error', error => {
    process.stdout.write(error)
})

req.end()