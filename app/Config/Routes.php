<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/dashboard/(:segment)', 'Dashboard::index/$1');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard/Mahasiswa/survey-dosen', 'SurveyMahasiswa::dosen', ['filter' => 'auth']);
$routes->get('/dashboard/Mahasiswa/survey-prasarana', 'SurveyMahasiswa::prasarana', ['filter' => 'auth']);
$routes->get('/dashboard/Mahasiswa/survey-visi-misi', 'SurveyMahasiswa::visiMisi', ['filter' => 'auth']);
$routes->post('/dashboard/Mahasiswa/survey-dosen', 'SurveyMahasiswa::submitDosen', ['filter' => 'auth']);
$routes->post('/dashboard/Mahasiswa/survey-visi-misi', 'SurveyMahasiswa::submitVisiMisi', ['filter' => 'auth']);
$routes->post('/dashboard/Mahasiswa/survey-prasarana', 'SurveyMahasiswa::submitPrasarana', ['filter' => 'auth']);