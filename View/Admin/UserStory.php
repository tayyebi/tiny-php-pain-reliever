<a href="../Statistics">Back</a>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Page</th>
      <th scope="col">Username</th>
      <th scope="col">Browser</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 0; foreach ($Data['UserStory'] as $Row) { $i++?>
    <tr <?php echo ($i%2) ? 'class="color-gold background-dark"' : 'class="background-dark color-white"' ?>>
      <td scope="row"><?php echo $Row['Submit']?></td>
      <td><?php echo $Row['Uri']?></td>
      <td><?php echo $Row['PHP_AUTH_USER']?></td>
      <td><?php echo $Row['HTTP_USER_AGENT']?></td>
    </tr>
    <?php } ?>
  </tbody>
  <tfoot">
    <tr>
      <td>Date</td>
      <td>Page</td>
    </tr>
  </tfoot>
</table>