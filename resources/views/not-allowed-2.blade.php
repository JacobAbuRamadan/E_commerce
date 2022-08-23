<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NOT ALLOWED</title>
</head>
<body>
    <div class="container"></div>
<style>
    ::-webkit-scrollbar {
    display: none;
}
html, body {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  background: black;
  color: lightgreen;
}
.container {
  display: block;
  padding: 20px;
  font-size: 20px;
  font-weight: bold;
  font-family: monospace;
}
.container span {
  display: inline-block;
  width: 50px;
  height: 20px;
}
</style>

<script>
    (function(){
  var i = 0;
  var speed = 0;
  var txt = 'struct group_info init_groups = { .usage = ATOMIC_INIT(2) };<br><br>struct group_info *groups_alloc(int gidsetsize){<br><br><span></span>struct group_info *group_info;<br><br><span></span>int nblocks;<br><br><span></span>int i;<br><br><br><br><span></span>nblocks = (gidsetsize + NGROUPS_PER_BLOCK - 1) / NGROUPS_PER_BLOCK;<br><br><span></span>/* Make sure we always allocate at least one indirect block pointer */<br><br><span></span>nblocks = nblocks ? : 1;<br><br><span></span>group_info = kmalloc(sizeof(*group_info) + nblocks*sizeof(gid_t *), GFP_USER);<br><br><span></span>if (!group_info)<br><br><span></span><span></span>return NULL;<br><br><span></span>group_info->ngroups = gidsetsize;<br><br><span></span>group_info->nblocks = nblocks;<br><br><span></span>atomic_set(&group_info->usage, 1);<br><br><br><br><span></span>if (gidsetsize <= NGROUPS_SMALL)<br><br><span></span><span></span>group_info->blocks[0] = group_info->small_block;<br><br><span></span>else {<br><br><span></span><span></span>for (i = 0; i < nblocks; i++) {<br><br><span></span><span></span><span></span>gid_t *b;<br><br><span></span><span></span><span></span>b = (void *)__get_free_page(GFP_USER);<br><br><span></span><span></span><span></span>if (!b)<br><br><span></span><span></span><span></span><span></span>goto out_undo_partial_alloc;<br><br><span></span><span></span><span></span>group_info->blocks[i] = b;<br><br><span></span><span></span>}<br><br><span></span>}<br><br><span></span>return group_info;<br><br><br><br>out_undo_partial_alloc:<br><br><span></span>while (--i >= 0) {<br><br><span></span><span></span>free_page((unsigned long)group_info->blocks[i]);<br><br><span></span>}<br><br><span></span>kfree(group_info);<br><br><span></span>return NULL;<br><br>}<br><br><br><br>EXPORT_SYMBOL(groups_alloc);<br><br><br><br>void groups_free(struct group_info *group_info)<br><br>{<br><br><span></span>if (group_info->blocks[0] != group_info->small_block) {<br><br><span></span><span></span>int i;<br><br><span></span><span></span>for (i = 0; i < group_info->nblocks; i++)<br><br><span></span><span></span><span></span>free_page((unsigned long)group_info->blocks[i]);<br><br><span></span>}<br><br><span></span>kfree(group_info);<br><br>}<br><br><br><br>EXPORT_SYMBOL(groups_free);<br><br><br><br>SYSTEM HACKED :)';

  function hacker() {
    if (i < txt.length) {

      var cc = txt.charAt(i);
      if (cc === '<') {
        while (txt.charAt(i+1) !== '>') {
          i++;
          cc += txt.charAt(i);
        }
        i++;
        cc += txt.charAt(i);
      }
      document.querySelector(".container").innerHTML += cc;
      i++;
      setTimeout(hacker, speed);
    }
    window.scrollTo(0, document.body.scrollHeight);
  }
  hacker();
})();
</script>

</body>

</html>
