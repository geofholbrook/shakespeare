
const _ = require('lodash')
const fs = require('fs')
const express = require('express')

const sonnet_files = fs.readdirSync("./sonnets")

var sonnets = []

sonnet_files.forEach( filename => {
    sonnets.push(
        _.flatten(
            fs.readFileSync('sonnets/' + filename).toString().split("\n")
            .map(line => 
                line.split(" ")
                .map(str => str.trim().replace(/\W/gi, ""))
                .filter(str => str != "")
            )
            .filter (line => line.length > 0)
        )    
    )
})

const app = express()

app.get('/', function (req, res) {
  res.send(sonnets)
})

app.listen(3000, function () {
  console.log('Sonnet app listening at localhost:/3000')
})

