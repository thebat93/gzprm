from osgeo import gdal
import sys

ds = gdal.Open('output.tif')
srcband = ds.GetRasterBand(1)
(min,max) = srcband.ComputeRasterMinMax()
print 'MIN', min, 'MAX', max
