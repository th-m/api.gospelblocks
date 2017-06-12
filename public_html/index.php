<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>GospelBlocks API</title>
    <style type="text/css">
    .centered {
      position: fixed;
      top: 50%;
      left: 50%;
      /* bring your own prefixes */
      transform: translate(-50%, -50%);
    }
    table, thead, tbody, tr{
      width:100%;
      display: block;
    }
    th, td {
      width:49%;
      display: inline-block;
    }
    </style>
  </head>
  <body>
    <div class="">
      <h1>You hit the gospelblocks api</h1>
      <h3>This is a free to use rest API that provides access to all scriptures within the standard works</h3>
    </div>
    <br>
    <br>
      <p>Here is a quick break down of how to use the API.
      <br>*note that all endpoints are preceded by http://api.gospelblocks.com/v1/</p>
      <table>
        <thead>
          <tr>
            <th>End Point</th>
            <th>Returns</th>
            <!-- <th>Notes</th> -->
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>volumes</td>
            <td>All volumes within standard works.</td>
          </tr>
          <tr>
            <td>/volume/{volume}</td>
            <td>All books within volume</td>
          </tr>
          <tr>
            <td>/volume/{volume}/book/{book}</td>
            <td>Returns all chapters within book</td>
          </tr>
          <tr>
            <td>/volume/{volume}/book/{book}/chapter/{chapter}</td>
            <td>All verses within chapter</td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
