<!DOCTYPE html>
<html>
<head>
<style>
body{
  background-color: #e67e00;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: orange;
  border-radius: 15px;
  margin: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  display: flex;
  justify-content: center;
  align-items: center;
}

li {
  float: left;
  margin: auto;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-family: Arial, sans-serif;
}

li a:hover {
  background-color: #e67e00;
  border-radius: 15px;
}

.active {
  background-color: #cc6d00;
  border-radius: 10px;
}

li:first-child a {
  border-top-left-radius: 15px;
  border-bottom-left-radius: 15px;
}

li:last-child a {
  border-top-right-radius: 15px;
  border-bottom-right-radius: 15px;
}
</style>
</head>
<body>

<ul>
  <li><a class="active" href="#requests">Delivery Request</a></li>
  <li><a href="#pendint">Pending</a></li>
  <li><a href="#profile">Profile</a></li>
</ul>

<script>
const links = document.querySelectorAll('ul li a');
links.forEach(link => {
  link.addEventListener('click', function(e) {
    links.forEach(a => a.classList.remove('active'));
    this.classList.add('active');
  });
});
</script>

</body>
</html>