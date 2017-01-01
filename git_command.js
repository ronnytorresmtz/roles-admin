Git an GitHub Commands
======================

BRANCHES
//create branch
git branch {Branch Name}

//Delete Local and Remote Branch
git branch -D {Branch Name}
git push origin --delete {Branch Name}

MERGE
//Merge branches with master
git checkout master
gti merge {Branch Name}
git push origin master

LOG
//Tree graphic log with commit comment in one line
git log --graph --oneline --decorate --all
