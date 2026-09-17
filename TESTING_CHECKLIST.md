# Testing Checklist

| Test ID | Test | Expected Result | Actual Result | Pass/Fail |
|---|---|---|---|---|
| T01 | Home page loads | Home page opens and shows search form plus available properties. |  |  |
| T02 | Properties load from database | Properties page displays listings from MySQL. |  |  |
| T03 | Location filter works | Matching properties for the entered location are displayed. |  |  |
| T04 | Minimum price filter works | Only properties at or above the minimum price are displayed. |  |  |
| T05 | Maximum price filter works | Only properties at or below the maximum price are displayed. |  |  |
| T06 | Property type filter works | Only properties of the selected type are displayed. |  |  |
| T07 | Property details load | Selected property image, description, and contact details appear. |  |  |
| T08 | Inquiry submits successfully | Valid inquiry is saved and success message appears. |  |  |
| T09 | Invalid inquiry is rejected | Missing or invalid fields show clear validation errors. |  |  |
| T10 | Admin login works | Correct admin credentials redirect to admin listings. |  |  |
| T11 | Incorrect admin login is rejected | Wrong credentials show an error message. |  |  |
| T12 | Unauthorized admin page is protected | Visiting admin pages without login redirects to login. |  |  |
| T13 | Admin can add property | New property is saved and appears in listings. |  |  |
| T14 | Admin can edit property | Updated property data is saved and displayed. |  |  |
| T15 | Admin can delete property | Deleted property is removed from listings. |  |  |
| T16 | Admin can view inquiries | Submitted inquiries appear in the admin inquiries table. |  |  |
| T17 | Logout works | Admin session ends and login page appears. |  |  |
| T18 | Website works on mobile | Layout adapts without horizontal scrolling or broken forms. |  |  |
| T19 | Website works on tablet | Layout remains readable and usable on tablet width. |  |  |
| T20 | Basic invalid/malicious input is handled safely | Input is validated, escaped, and does not execute scripts or SQL. |  |  |

