var http = require("http");
var express = require('express');
var app = express();
var mysql      = require('mysql');
var bodyParser = require('body-parser');

//start mysql connection
var connection = mysql.createConnection({
  host     : 'localhost', //mysql database host name
  user     : 'root', //mysql database user name
  password : '', //mysql database password
  database : 'nodejs' //mysql database name
});

connection.connect(function(err) {
  if (err) throw err
  console.log('You are now connected with mysql database...')
})
//end mysql connection

//start body-parser configuration
app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
  extended: true
}));
//end body-parser configuration

//create app server
var server = app.listen(3009,  "127.0.0.1", function () {

  var host = server.address().address
  var port = server.address().port

  console.log("Example app listening at http://%s:%s", host, port)

});

//rest api to get all customers
app.get('/customer', function (req, res) {
   connection.query('select * from customer', function (error, results, fields) {
	  if (error) throw error;
	  res.end(JSON.stringify(results));
	});
});
//rest api to get a single customer data
app.get('/customer/:id', function (req, res) {
   connection.query('select * from customer where Id=?', [req.params.id], function (error, results, fields) {
	  if (error) throw error;
	  res.end(JSON.stringify(results));
	});
});

//rest api to create a new customer record into mysql database
app.post('/customer', function (req, res) {
   var params  = req.body;
   console.log(params);
   connection.query('INSERT INTO customer SET ?', params, function (error, results, fields) {
	  if (error) throw error;
	  res.end(JSON.stringify(results));
	});
});

//rest api to update record into mysql database
app.put('/customer', function (req, res) {
   connection.query('UPDATE `customer` SET `Name`=?,`Address`=?,`Country`=?,`Phone`=? where `Id`=?', [req.body.Name,req.body.Address, req.body.Country, req.body.Phone, req.body.Id], function (error, results, fields) {
	  if (error) throw error;
	  res.end(JSON.stringify(results));
	});
});

//rest api to delete record from mysql database
app.delete('/customer', function (req, res) {
   console.log(req.body);
   connection.query('DELETE FROM `customer` WHERE `Id`=?', [req.body.Id], function (error, results, fields) {
	  if (error) throw error;
	  res.end('Record has been deleted!');
	});
});




/*
npm install express
npm install mysql
npm install body-parser
npm install http


DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `Name`, `Address`, `Country`, `Phone`, `Created_on`, `Updated_on`) VALUES
(1, 'Alok Ranjan', 'c6/342 yamuna vihar', 'india', 828524891, '2022-08-05 17:43:00', '2022-08-05 17:43:00'),
(2, 'Atul Kumar', 'c6/342 yamuna vihar', 'india', 828524891, '2022-08-05 17:43:00', '2022-08-05 17:43:00');
COMMIT;
*/
