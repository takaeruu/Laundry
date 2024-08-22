<div class="col-lg-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Log Activity</h4>

      <!-- Form Filter -->
      <form action="<?= base_url('ActivityLogController/filterActivities') ?>" method="get">
        <div class="form-group">
          <label for="user_filter">Filter by User</label>
          <select class="form-control" name="user_filter" id="user_filter">
            <option value="">-- Select User --</option>
            <?php foreach ($users as $user) { ?>
              <option value="<?= $user->id_user?>">
                <?= $user->id_user ?> / <?= $user->username ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <input type="hidden" name="id_user" value="<?= $currentUserId ?>" />
        <button type="submit" class="btn btn-primary">Filter</button>
      </form>
      <br>
      <a href="<?= base_url('home/hapus_aktivitas') ?>">
        <button class="btn btn-danger">
          <i class="now-ui-icons ui-1_check"></i> Delete
        </button>
      </a>

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>ID User</th>
              <th>Menu</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($activities as $activity): ?>
              <tr>
                <td><?= $activity->id_user ?></td>
                <td><?= $activity->menu ?></td>
                <td><?= $activity->created_at ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>