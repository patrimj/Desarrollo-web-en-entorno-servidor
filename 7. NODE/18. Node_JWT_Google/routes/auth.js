const {Router } = require('express');
const router = Router();
const {login, googleSignin} = require('../controllers/auth');

router.post('/login', login);
router.post('/google', googleSignin);

module.exports = router