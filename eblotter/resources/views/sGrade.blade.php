<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Grade Report</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sGrade.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body>

        <!-- Back Button -->
        <button class="back-btn" onclick="window.history.back();">
            <i class="fas fa-arrow-left"></i> 
        </button>
    


    <h1>My Grade Report</h1>
    <div class="Info">
        <div class="info-box">
            <div class="label">Student:</div>
            <div class="content"></div>
        </div>

        <div class="info-box">
            <div class="label">Semester:</div>
            <div class="content"></div>
        </div>
        <div class="info-box">
            <div class="label">School Year:</div>
            <div class="content"></div>
        </div>
        <div class="info-box">
            <div class="label">Subject:</div>
            <div class="content"></div>
        </div>
        <div class="info-box">
            <div class="label">Instructor:</div>
            <div class="content"></div>
        </div>
    </div> 
    

    <div class="container">
       
        <div class="section">
            <h3>Attendance (10%)</h3>
            <table>
                <tr>
                    <th>#</th>
                    <th>Score</th>
                    <th>#</th>
                    <th>Score</th>
                </tr>
                <tr><td>1</td><td></td><td>11</td><td></td></tr>
                <tr><td>2</td><td></td><td>12</td><td></td></tr>
                <tr><td>3</td><td></td><td>13</td><td></td></tr>
                <tr><td>4</td><td></td><td>14</td><td></td></tr>
                <tr><td>5</td><td></td><td>15</td><td></td></tr>
                <tr><td>6</td><td></td><td>16</td><td></td></tr>
                <tr><td>7</td><td></td><td>17</td><td></td></tr>
                <tr><td>8</td><td></td><td>18</td><td></td></tr>
                <tr><td>9</td><td></td><td>19</td><td></td></tr>
                <tr><td>10</td><td></td><td>20</td><td></td></tr>
                <table class="score-table">
                    <tr>
                        <td class="score-label">Total Score</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Percentage Score</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Weighted Score</td>
                        <td class="score-value"></td>
                    </tr>
                </table>
                
                
                
            </table>
        </div>

        <!-- Performance Task -->
        <div class="section">
            <h3>Written Work (30%)</h3>
            <table>
                <tr>
                    <th>#</th>
                    <th>Score</th>
                    <th>#</th>
                    <th>Score</th>
                </tr>
                <tr><td>1</td><td></td><td>11</td><td></td></tr>
                <tr><td>2</td><td></td><td>12</td><td></td></tr>
                <tr><td>3</td><td></td><td>13</td><td></td></tr>
                <tr><td>4</td><td></td><td>14</td><td></td></tr>
                <tr><td>5</td><td></td><td>15</td><td></td></tr>
                <tr><td>6</td><td></td><td>16</td><td></td></tr>
                <tr><td>7</td><td></td><td>17</td><td></td></tr>
                <tr><td>8</td><td></td><td>18</td><td></td></tr>
                <tr><td>9</td><td></td><td>19</td><td></td></tr>
                <tr><td>10</td><td></td><td>20</td><td></td></tr>
                <table class="score-table">
                    <tr>
                        <td class="score-label">Total Score</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Percentage Score</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Weighted Score</td>
                        <td class="score-value"></td>
                    </tr>
                </table>
            </table>
        </div>

        <!-- Performance -->
        <div class="section">
            <h3>Performance (40%)</h3>
            <table>
                <tr>
                    <th>#</th>
                    <th>Score</th>
                    <th>#</th>
                    <th>Score</th>
                </tr>
                <tr><td>1</td><td></td><td>11</td><td></td></tr>
                <tr><td>2</td><td></td><td>12</td><td></td></tr>
                <tr><td>3</td><td></td><td>13</td><td></td></tr>
                <tr><td>4</td><td></td><td>14</td><td></td></tr>
                <tr><td>5</td><td></td><td>15</td><td></td></tr>
                <tr><td>6</td><td></td><td>16</td><td></td></tr>
                <tr><td>7</td><td></td><td>17</td><td></td></tr>
                <tr><td>8</td><td></td><td>18</td><td></td></tr>
                <tr><td>9</td><td></td><td>19</td><td></td></tr>
                <tr><td>10</td><td></td><td>20</td><td></td></tr>
                <table class="score-table">
                    <tr>
                        <td class="score-label">Total Score</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Percentage Score</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Weighted Score</td>
                        <td class="score-value"></td>
                    </tr>
                </table> 
            </table>
        </div>

        <!-- Examination & Grades Summary & Status -->
        <div class="examination-container">
            <div class="section">
                <h3>Examination (30%)</h3>
                <table>
                    <tr>
                        <td class="score-label">Mifterm</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Finalterm</td>
                        <td class="score-value"></td>
                    </tr>
                </table>
            </div>

            <div class="grades-summary">
                <h3>Grades Summary</h3>
                <table>
                    <tr>
                        <td class="score-label">Attendance</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Written Work</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Performace</td>
                        <td class="score-value"></td>
                    </tr>
                    <tr>
                        <td class="score-label">Semester Grade</td>
                        <td class="score-value"></td>
                    </tr>
                </table>
            </div>

            <div class="status">
                <h3>Status</h3>
                <div class="status-box">Pass/Fail</div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        NSTP SERVICE RECORDS
    </div>


</body>
</html>
