#! /bin/sh
#
# Deploy website to actual hosting environment
#
# Any argument passed to the script will be added to the rsync command line.

REMOTE_USER=deb4664
REMOTE_HOST=halfje-bruin.nl
REMOTE_DIR=domains/${REMOTE_HOST}/public_html

SSH_KEYFILE=${HOME}/.ssh/halfjebruin-ssh
LOCAL_DIR=../wwwroot/
EXCLUDES=.rsync-excludes

LOGFILE=deploy-"$(date '+%Y%m%d-%H%M%S')".log

rsync "$@"  \
    --verbose \
    --archive \
    --checksum \
    --chmod=D775,F664 \
    --no-group \
    --no-times \
    --omit-dir-times \
    --delete-during \
    --exclude-from=${EXCLUDES} \
    --log-file=${LOGFILE} \
    --rsh="ssh -i '${SSH_KEYFILE}'" \
    ${LOCAL_DIR} \
    ${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_DIR}
